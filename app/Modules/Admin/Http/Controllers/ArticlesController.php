<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;

class ArticlesController extends BaseController
{
     public $model = \App\Modules\Admin\Models\Article::class;

     public $view_prefix_path = "admin::admin.";
}
