<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;

class CategoriesController extends BaseController
{
     public $model = \App\Modules\Admin\Models\Category::class;

     public $view_prefix_path = "admin::admin.";
}
