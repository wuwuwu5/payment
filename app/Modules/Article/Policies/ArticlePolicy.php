<?php

namespace App\Modules\Article\Policies;

use App\Modules\Article\Models\Article;
use App\Modules\Article\Models\User;

class ArticlePolicy extends BasePolicy
{
    /**
     * 更新
     *
     * @param User $user
     * @param Article $article
     * @return bool
     */
    public function update(User $user, Article $article)
    {
        return $user->id == $article->creator_id;
    }
}
