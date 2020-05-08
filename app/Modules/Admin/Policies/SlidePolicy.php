<?php

namespace App\Modules\Admin\Policies;

use App\Modules\Admin\Models\Article;
use App\Modules\Admin\Models\Slide;
use App\Modules\Admin\Models\User;

class SlidePolicy extends BasePolicy
{
    /**
     * 更新
     *
     * @param User $user
     * @param Slide $slide
     * @return bool
     */
    public function update(User $user, Slide $slide)
    {
        return $user->id == $slide->creator_id;
    }
}
