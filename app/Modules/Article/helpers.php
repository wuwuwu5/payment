<?php

// 文章相关辅助函数
{
    if (!function_exists('getArticleColumns')) {
        // 获取文章导航
        function getArticleColumns($id)
        {
            $article = \App\Modules\Article\Models\Article::query()
                ->with([
                    'column' => function ($q) {
                        $q->select('id', 'nickname', 'name', 'level', 'path', 'top_id', 'pid');
                    },
                    'column2' => function ($q) {
                        $q->select('id', 'nickname', 'name', 'level', 'path', 'top_id', 'pid');
                    },
                ])
                ->findOrFail($id);

            if (empty($article)) {
                return [];
            }

            $array = [];

            if (!empty($article->column)) {
                $array[] = $article->column->toArray();
            }
            if (!empty($article->column2)) {
                $array[] = $article->column2->toArray();
            }

            return $array;
        }
    }

    if (!function_exists('getColumnArticles')) {
        // 获取导航下的文章
        function getColumnArticles($column_id, $type = 'now', $num = 10, $exclude = null, $level = 2)
        {
            $articles = \App\Modules\Article\Models\Article::query()
                ->when($level == 2 && !empty($column_id), function ($q) use ($column_id) {
                    $q->where('column2_id', $column_id);
                })
                ->when($level == 1 && !empty($column_id), function ($q) use ($column_id) {
                    $q->where('column_id', $column_id);
                })
                ->when($type == 'now', function ($q) {
                    $q->frontIndex();
                })
                ->when($type == 'hot', function ($q) {
                    $q->hot();
                })
                ->when($type == 'rand', function ($q) {
                    $q->random();
                })
                ->when($exclude > 0, function ($q) use ($exclude) {
                    $q->where('id', '<>', $exclude);
                })
                ->take($num)
                ->get();

            return $articles;
        }
    }

    // 获取文章信息
    if (!function_exists('getArticleInfoOnCache')) {
        function getArticleInfoOnCache($id, $field = '')
        {
            $num = $id % 10;

            $data = unserialize(\Illuminate\Support\Facades\Redis::hget('articles_info:' . $num, $id));

            if (empty($data)) {

                if (!empty($field)) {
                    return '';
                }

                return [];
            }

            if (empty($field)) {
                return $data;
            }

            return data_get($data, $field, '');
        }
    }

    // 获取文章信息
    if (!function_exists('incrArticleViewCount')) {
        function incrArticleViewCount($id, $field = 'view_count')
        {
            $info = getArticleInfoOnCache($id);

            if (empty($info)) {
                return false;
            }

            $info[$field]++;

            return coverArticleCache($id, $info);
        }
    }

    // 覆盖文章信息
    if (!function_exists('coverArticleCache')) {
        function coverArticleCache($id, $info)
        {
            $key = getArticleInfoOnCacheKey($id);

            return \Illuminate\Support\Facades\Redis::hset($key, $id, serialize($info));
        }
    }

    // 覆盖文章信息
    if (!function_exists('position')) {
        function position($id)
        {
            return $id % 10;
        }
    }

    // 文章cache_key
    if (!function_exists('getArticleInfoOnCacheKey')) {
        function getArticleInfoOnCacheKey($id)
        {
            return 'articles_info:' . position($id);
        }
    }

    // formatRedisKey
    if (!function_exists('formatRedisKey')) {

        function formatRedisKey($key, ...$params)
        {
            $sub = config('redis_key.' . $key);

            $last_sub = implode(':', $params);

            return $sub . ':' . $last_sub;
        }
    }

    // formatArticleInfo
    if (!function_exists('formatArticleInfo')) {
        /**
         * 基本信息(基本用于新创建的数据)
         *
         * @param $article
         * @return array
         */
        function formatArticleInfo($article)
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
                'column_id' => $article->column_id,
                'column2_id' => $article->column2_id,
            ];
        }
    }

    // getColumnKey
    if (!function_exists('getColumnKey')) {
        function getColumnKey($article, $type = 'hot')
        {
            if (empty($article->column2_id) && empty($article->column_id)) {
                $column_hot_key = $type . '_articles_all';
            } else {
                if (empty($article->column2_id)) {
                    $column_hot_key = $type . '_articles:' . $article->column_id;
                } else {
                    $column_hot_key = $type . '_articles:' . $article->column2_id;
                }
            }

            return $column_hot_key;
        }
    }

    // getColumnKey
    if (!function_exists('calculateScore')) {
        function calculateScore($info)
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
    }

    // syncArticleInfoJob
    if (!function_exists('syncArticleInfoJob')) {
        function syncArticleInfoJob($article, $mark = false)
        {
            \App\Modules\Article\Jobs\SyncArticleInfoToCache::dispatch($article, $mark)
                ->onConnection('redis')
                ->onQueue('sync_article');
        }
    }

    // likeArticleOrNot
    if (!function_exists('likeArticleOrNot')) {
        function likeArticleOrNot($id, $user_id)
        {
            $rand_key = formatRedisKey('give_articles_users', $id);

            // 获取排名
            $rank = \Illuminate\Support\Facades\Redis::zrank($rand_key, $user_id);

            if ($rank !== false) {

                $score = \Illuminate\Support\Facades\Redis::ZSCORE($rand_key, $user_id);

                if ((int)($score) != -1) {
                    return false;
                }

                return true;
            } else {
                return true;
            }
        }
    }
}

