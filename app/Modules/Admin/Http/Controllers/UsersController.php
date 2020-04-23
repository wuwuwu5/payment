<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{
     public $model = \App\Modules\Admin\Models\User::class;

     public $view_prefix_path = "admin::admin.";
}
