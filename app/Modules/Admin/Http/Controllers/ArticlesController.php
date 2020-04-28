<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use Illuminate\Http\Request;

class ArticlesController extends BaseController
{
    public $model = \App\Modules\Admin\Models\Article::class;

    public $view_prefix_path = "admin::admin.";

    /**
     * 参数
     *
     * @param Category $category
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function column2(Category $category, Request $request)
    {
        $category->categoryGroup()->where('name', CategoryGroup::FRONT_COLUMN)->firstOrFail();

        if ($category->pid == 0) {
            $top_id = $category->id;
            $path = $category->id . '%';
        } else {
            $top_id = $category->top_id;
            $path = $category->path . ',' . $category->id . '%';
        }

        $categories = Category::query()
            ->where(compact('top_id'))
            ->where('path', 'like', $path)
            ->select('id', 'nickname as name', 'pid', 'category_group_id')
            ->get()
            ->toArray();

        $categories = generateCategoriesTree($categories);

        return $this->returnOkApi(null, $categories);
    }
}
