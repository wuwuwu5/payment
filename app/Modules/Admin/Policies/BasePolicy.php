<?php

namespace App\Modules\Admin\Policies;

class BasePolicy
{
    public function before($user, $ability)
    {
        if ($user->is_admin == 1) {
            return true;
        }

        if ($user->hasRoles(['super_admin', 'admin'])) {
            return true;
        }
    }
}
