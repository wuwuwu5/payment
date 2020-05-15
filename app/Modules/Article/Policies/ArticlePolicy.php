<?php

namespace App\Modules\Article\Policies;

use App\Modules\Admin\Models\User;
use App\Modules\Admin\Policies\BasePolicy;
use App\Modules\Article\Models\Article;

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
