<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;

class UsersController extends BaseController
{
     public $model = \App\Modules\Admin\Models\User::class;

     public $view_prefix_path = "admin::admin.";
}
