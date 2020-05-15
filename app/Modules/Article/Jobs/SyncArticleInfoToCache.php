<?php

namespace App\Modules\Article\Jobs;

use App\Modules\Article\Models\Article;
use App\Modules\Traits\ArticleTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;

class SyncArticleInfoToCache implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    use ArticleTrait;

    /**
     * @var Article
     */
    private $article;
    /**
     * @var bool
     */
    private $is_update;

    /**
     * Create a new job instance.
     *
     * @param Article $article
     * @param bool $is_update
     */
    public function __construct($article, $is_update = false)
    {
        $this->article = $article;
        $this->is_update = $is_update;
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $article = Article::find($this->article->id);

        if (empty($article)) {
            return;
        }

        // 可以从redis中获取数据
        $info = $this->is_update == true ? $this->updateGetInfo($article) : formatArticleInfo($article);

        // 发布
        if ($article->is_published == 1) {
            $score = $this->calculateScore($info);
            $published_at = $info['published_at'];
        } else {
            $published_at = $score = -1;
        }

        // 储存
        Redis::eval($this->luaScript(), 5, ...[
            'hot_articles_all',
            getColumnKey($article, 'hot'),
            'published_articles',
            getColumnKey($article, 'published'),
            getArticleInfoOnCacheKey($article->id),
            $article->id,
            $score,
            $published_at,
            serialize($info)
        ]);
    }


    /**
     * 分数
     *
     * @param $info
     * @return float|int
     */
    public function calculateScore($info)
    {
        // 评论数
        $log_post_count = ($info['post_count'] == 0) ? 0 : log($info['post_count']);
        // 查看数
        $log_view_count = ($info['view_count'] == 0) ? 0 : log($info['view_count'], 10);
        // 分子
        $molecule = ($log_view_count + $info['give_count'] + $info['collection_count'] + $log_post_count);
        // 分母
        $denominator = pow(($info['created_at'] / 3600 / 2 + $info['published_at'] / 3600 / 2 + 1), 0.3);

        if ($molecule == 0) {
            return 0;
        }

        return $molecule / $denominator;
    }


    /**
     * 更新获取数据
     *
     * @param $article
     * @return array|mixed|string
     */
    public function updateGetInfo($article)
    {
        $info = getArticleInfoOnCache($article->id);

        if (!empty($info)) {
            return $info;
        }

        return formatArticleInfo($article);
    }

    /**
     * 脚本
     *
     * @return string
     */
    public function luaScript()
    {
        return <<<LUA

local function deleteRedundantData(key)
    local hot_count = redis.call('ZCARD', key)
    if (hot_count > 200) then
        local member = redis.call('ZREVRANGE', key, 200, -1)
        for i, v in ipairs(member) do
            redis.call('ZREM', key, v)
        end 
    end
end 

local all_hot_key = KEYS[1]
local column_hot_key = KEYS[2]

local publish_key = KEYS[3]
local column_publish_key = KEYS[4]
local articles_info_key = KEYS[5]

local article_id = ARGV[1]
local hot_score = ARGV[2]
local publish = tonumber(ARGV[3])
local info = ARGV[4]

redis.call('ZADD', all_hot_key, hot_score, article_id)
deleteRedundantData(all_hot_key)

redis.call('ZADD', column_hot_key, hot_score, article_id)
deleteRedundantData(column_hot_key)


if (publish < 0) then
    redis.call('ZREM', publish_key, article_id)
    redis.call('ZREM', column_publish_key, article_id)
else
     redis.call('ZADD', publish_key, publish, article_id)
     deleteRedundantData(publish_key)
     redis.call('ZADD', column_publish_key, publish, article_id)
     deleteRedundantData(column_publish_key)
end

redis.call('HSET', articles_info_key, article_id, info)
LUA;
    }
}
