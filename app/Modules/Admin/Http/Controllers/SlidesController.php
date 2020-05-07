<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\CategoryGroup;
use Illuminate\Http\Request;

class SlidesController extends BaseController
{
    public $model = \App\Modules\Admin\Models\Slide::class;

    public $view_prefix_path = "admin::admin.";

    /**
     * @param $data
     * @return array
     */
    public function pushDataToIndexData($data)
    {
        $category_group = CategoryGroup::query()->where('name', CategoryGroup::SLIDES)->first();

        return array_merge($data, compact('category_group'));
    }
}
