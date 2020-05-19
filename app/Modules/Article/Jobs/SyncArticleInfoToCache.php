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
        $article = $this->article;

        // 可以从redis中获取数据
        $info = $this->is_update == true ? $this->updateGetInfo($article) : formatArticleInfo($article);

        // 获取缓存中的久栏目
        $old_column_id = $info['column_id'];
        $old_column2_id = $info['column2_id'];

        // 重新在赋值一次
        $info['title'] = $article->title;
        $info['column_id'] = $article->column_id;
        $info['column2_id'] = $article->column2_id;
        $info['published_at'] = $article->published_at->timestamp;

        // 发布
        if ($article->is_published == 1) {
            $score = calculateScore($info);
            $published_at = $info['published_at'];
        } else {
            $published_at = -1;
        }

        // 储存
        Redis::eval($this->luaScript(), 9, ...[
            'hot_articles_all',
            'published_articles_all',
            getColumnKey2($article, 'hot', 1),
            getColumnKey2($article, 'hot', 2),
            getColumnKey2($article, 'published', 1),
            getColumnKey2($article, 'published', 2),
            getArticleInfoOnCacheKey($article->id),
            $this->getNeedDelKey($old_column_id, $old_column2_id, $info, 'hot'),
            $this->getNeedDelKey($old_column_id, $old_column2_id, $info, 'published'),
            $article->id,
            $article->column_id,
            $article->column2_id,
            $score,
            $published_at,
            serialize($info)
        ]);

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
     * 删除
     *
     * @param $old_column_id
     * @param $old_column2_id
     * @param $info
     * @param $type
     * @return string
     */
    public function getNeedDelKey($old_column_id, $old_column2_id, $info, $type)
    {
        $need_del_key = '';

        if (empty($old_column2_id) && empty($old_column_id)) {
            if (!empty($info['column2_id']) || !empty($info['column_id'])) {
                $need_del_key = $type . '_articles_all';
            }
        } else {
            if (!empty($old_column2_id) && $info['column2_id'] != $old_column2_id) {
                $need_del_key = $type . '_articles:' . $old_column2_id;
            } else if (!empty($old_column_id) && empty($old_column2_id)) {
                if (!empty($info['column2_id']) || $old_column_id != $info['column_id']) {
                    $need_del_key = $type . '_articles:' . $old_column_id;
                }
            }
        }

        return $need_del_key;
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
local publish_key = KEYS[2]

local hot_column_key = tostring(KEYS[3])
local hot_column2_key = tostring(KEYS[4])

local publish_column_key = tostring(KEYS[5])
local publish_column2_key = tostring(KEYS[6])

local articles_info_key = KEYS[7]
local del_hot_key = tostring(KEYS[8])
local del_publish_key = tostring(KEYS[9])

local article_id = ARGV[1]
local column_id = tonumber(ARGV[2])
local column2_id = tonumber(ARGV[3])
local hot_score = ARGV[4]
local publish = tonumber(ARGV[5])
local info = ARGV[6]


redis.call('ZADD', all_hot_key, hot_score, article_id)
deleteRedundantData(all_hot_key)

 if (column_id > 0) then
      redis.call('ZADD', hot_column_key, hot_score, article_id)
      deleteRedundantData(hot_column_key)
 end
 
 if (column2_id > 0) then
      redis.call('ZADD', hot_column2_key, hot_score, article_id)
      deleteRedundantData(hot_column2_key)
 end




if (publish < 0) then
    redis.call('ZREM', publish_key, article_id)
    redis.call('ZREM', publish_column_key, article_id)
    redis.call('ZREM', publish_column2_key, article_id)
else
     redis.call('ZADD', publish_key, publish, article_id)
     deleteRedundantData(publish_key)
     
     if (column_id > 0) then
          redis.call('ZADD', publish_column_key, publish, article_id)
          deleteRedundantData(publish_column_key)
     end
     
     if (column2_id > 0) then
          redis.call('ZADD', publish_column2_key, publish, article_id)
          deleteRedundantData(publish_column2_key)
     end
end

redis.call('HSET', articles_info_key, article_id, info)

redis.call('ZREM', del_hot_key, article_id)
redis.call('ZREM', del_publish_key, article_id)

LUA;
    }
}
