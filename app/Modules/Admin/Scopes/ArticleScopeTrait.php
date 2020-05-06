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
            }
        ]);
    }
}
