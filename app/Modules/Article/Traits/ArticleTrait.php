<?php

namespace App\Modules\Traits;

use Illuminate\Support\Facades\Redis;

trait ArticleTrait
{
    /**
     * 基本信息(基本用于新创建的数据)
     *
     * @param $article
     * @return array
     */
    public function formatArticleInfo($article)
    {
        // 时间
        $created_at = $article->created_at->timestamp;
        $published_at = empty($article->published_at) ? 0 : $article->published_at->timestamp;

        // 数据
        return [
            'view_count' => $article->view_count,
            'give_count' => $article->give_count,
            'collection_count' => $article->collection_count,
            'post_count' => $article->post_count,
            'created_at' => $created_at,
            'published_at' => $published_at,
        ];
    }

    /**
     * 删除
     *
     * @param $article
     */
    public function deleteArticleOnRedis($article)
    {
        $num = $article->id % 10;

        // 删除
        Redis::hdel('articles_info:' . $num, $article->id);

        // 移除
        Redis::ZREM('published_articles', $article->id);

        // 移除
        Redis::ZREM('hot_articles_all', $article->id);
    }


    /**
     * 覆盖文章缓存
     *
     * @param $id
     * @return mixed
     */
    public function getArticleInfoOnCacheKey($id)
    {
        return 'articles_info:' . $this->position($id);
    }


    /**
     * 组装redis—key
     *
     * @param $key
     * @param array $params
     * @return string
     */
    public function formatRedisKey($key, ...$params)
    {
        $sub = config('redis_key.' . $key);

        $last_sub = implode(':', $params);

        return $sub . ':' . $last_sub;
    }

    /**
     * 位置
     *
     * @param $id
     * @return int
     */
    public function position($id)
    {
        return $id % 10;
    }
}
