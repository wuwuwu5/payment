<?php

namespace App\Modules\Admin\Policies;

use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Models\User;

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
