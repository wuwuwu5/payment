<?php

namespace App\Modules\Traits;

use Illuminate\Support\Facades\Redis;

trait ArticleTrait
{
    /**
     * 创建储存redis数据
     *
     * @param $article
     */
    public function storeArticleInfoOnRedis($article)
    {

        $num = $article->id % 10;

        // 数据
        $info = $this->redisArticleInfo($article);

        if ($article->is_published == 1 && $article->status == 1) {

            // 评论数
            $log_post_count = $article->post_count == 0 ? 0 : log($article->post_count);
            // 查看数
            $log_view_count = $article->view_count == 0 ? 0 : log($article->view_count, 10);

            // 分子
            $molecule = ($log_view_count + $article->give_count + $article->collection_count + $log_post_count);

            // 分母
            $denominator = pow(($info['created_at'] / 3600 / 2 + $info['published_at'] / 3600 / 2 + 1), 0.3);

            // 排行
            Redis::zadd('hot_articles_all', ($molecule / $denominator), $article->id);

            // 发布时间存入redis
            Redis::zadd('published_articles', $info['published_at'], $article->id);
        } else {
            // 存入
            Redis::zadd('published_articles', -1, $article->id);
            // 未发布
            Redis::zadd('hot_articles_all', -1, $article->id);
        }

        // 存入文章基本数据
        Redis::hset('articles_info:' . $num, $article->id, serialize($info));
    }

    /**
     * 创建储存redis数据
     *
     * @param $article
     */
    public function updateArticleInfoOnRedis($article)
    {
        $num = $article->id % 10;

        // 获取redis中的数据
        $info = unserialize(Redis::hget('articles_info:' . $num, $article->id));

        if (empty($info)) {
            $this->storeArticleInfoOnRedis($article);
        } else {
            $now_info = $this->redisArticleInfo($article);
            $info['published_at'] = $now_info['published_at'];

            // redis储存
            Redis::hset('articles_info:' . $num, $article->id, serialize($info));

            // 发布排名
            if ($article->is_published == 1) {
                // 评论数
                $log_post_count = $info['post_count'] == 0 ? 0 : log($info['post_count']);
                // 查看数
                $log_view_count = $info['view_count'] == 0 ? 0 : log($info['view_count'], 10);
                // 分子
                $molecule = ($log_view_count + $info['give_count'] + $info['collection_count'] + $log_post_count);
                // 分母
                $denominator = pow(($info['created_at'] / 3600 / 2 + $info['published_at'] / 3600 / 2 + 1), 0.3);

                // 排行
                Redis::zadd('hot_articles_all', ($molecule / $denominator), $article->id);

                // 排行
                Redis::zadd('published_articles', $now_info['published_at'], $article->id);
            } else {
                // 存入
                Redis::zadd('published_articles', -1, $article->id);

                // 未发布排行
                Redis::zadd('hot_articles_all', -1, $article->id);
            }
        }
    }

    /**
     * 基本信息
     *
     * @param $article
     * @return array
     */
    public function redisArticleInfo($article)
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
     * 获取文章缓存
     *
     * @param $id
     * @return mixed
     */
    public function getArticleInfoOnRedis($id)
    {
        $num = $id % 10;

        return unserialize(Redis::hget('articles_info:' . $num, $id));
    }

    /**
     * 覆盖文章缓存
     *
     * @param $id
     * @return mixed
     */
    public function getArticleInfoOnRedisKey($id)
    {
        $num = $id % 10;

        return 'articles_info:' . $num;
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
