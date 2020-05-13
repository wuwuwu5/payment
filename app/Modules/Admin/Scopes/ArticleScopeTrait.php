<?php

namespace App\Modules\Admin\Scopes;

trait ArticleScopeTrait
{
    /**
     * 首页文章归属
     *
     * @param $builder
     * @return mixed
     */
    public function scopeIndexSearch($builder)
    {
        $user = auth()->user();

        if ($user->is_admin == 1) {
            return $builder;
        }

        if ($user->hasRoles(['super_admin', 'admin'])) {
            return $builder;
        }

        return $builder->where('creator_id', $user->id);
    }

    /**
     * 首页with
     *
     * @param $builder
     * @return mixed
     */
    public function scopeIndexWith($builder)
    {
        return $builder->with([
            'category' => function ($query) {
                $query->select('id', 'nickname', 'name');
            },
            'creator' => function ($query) {
                $query->select('id', 'nickname', 'username');
            },
        ]);
    }

    /**
     * 获取首页最新文章
     *
     * @param $builder
     * @return mixed
     */
    public function scopeFrontIndex($builder)
    {
        return $builder
            ->where('is_published', 1)
            ->select('id', 'title', 'short_title', 'creator_id', 'category_id', 'published_at', 'cover')
            ->orderBy('published_at', 'desc')
            ->with([
                'tags' => function ($q) {
                    $q->with('tag:id,name,nickname');
                },
                'creator' => function ($query) {
                    $query->select('id', 'nickname', 'username');
                },
            ]);
    }


    /**
     * 获取首页最新文章
     *
     * @param $builder
     * @return mixed
     */
    public function scopeRandom($builder)
    {
        return $builder
            ->where('is_published', 1)
            ->select('id', 'title','cover')
            ->inRandomOrder();
    }

    /**
     * 获取推荐文章
     *
     * @param $builder
     * @return mixed
     */
    public function scopeHot($builder)
    {
        return $builder
            ->where('is_published', 1)
            ->where('is_commend', 1)
            ->select('id', 'title', 'short_title', 'creator_id', 'category_id', 'published_at', 'cover')
            ->orderBy('give_count', 'desc')
            ->orderBy('collection_count', 'desc')
            ->orderBy('post_count', 'desc')
            ->orderBy('published_at', 'desc')
            ->with([
                'tags' => function ($q) {
                    $q->with('tag:id,name,nickname');
                },
                'creator' => function ($query) {
                    $query->select('id', 'nickname', 'username');
                },
            ]);
    }
}
