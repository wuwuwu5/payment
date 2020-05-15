<?php

namespace App\Modules\Traits;

use Illuminate\Support\Facades\Redis;

trait ArticleTrait
{
    /**
     * 删除
     *
     * @param $article
     */
    public function deleteArticleOnRedis($article)
    {
        // 储存
        Redis::eval($this->deleteLuaScript(), 5, ...[
            'hot_articles_all',
            getColumnKey($article, 'hot'),
            'published_articles',
            getColumnKey($article, 'published'),
            getArticleInfoOnCacheKey($article->id),
            $article->id,
        ]);
    }

    /**
     * 脚本
     *
     * @return string
     */
    public function deleteLuaScript()
    {
        return <<<LUA
local all_hot_key = KEYS[1]
local column_hot_key = KEYS[2]
local publish_key = KEYS[3]
local column_publish_key = KEYS[4]
local articles_info_key = KEYS[5]
local article_id = ARGV[1]

redis.call('hdel', articles_info_key, article_id)
redis.call('ZREM', all_hot_key, article_id)
redis.call('ZREM', column_hot_key, article_id)
redis.call('ZREM', publish_key, article_id)
redis.call('ZREM', column_publish_key, article_id)
LUA;
    }
}
