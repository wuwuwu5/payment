<?php

namespace App\Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class CategoryGroupsController extends BaseController
{
     public $model = \App\Modules\Admin\Models\CategoryGroup::class;

     public $view_prefix_path = "admin::admin.";
}
