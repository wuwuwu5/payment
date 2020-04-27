<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends BaseController
{
    public $model = \App\Modules\Admin\Models\Category::class;

    public $view_prefix_path = "admin::admin.";

    /**
     * 首页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View|void
     */
    public function indexJson(Request $request)
    {
        $name = $request->input('type');

        if (empty($name)) {
            return abort(404);
        }

        $category_group = CategoryGroup::query()->where(compact('name'))->firstOrFail();

        $categories = $category_group
            ->categories()
            ->select('id', 'pid', 'nickname', 'name', 'weigh', 'status')
            ->orderBy('weigh', 'desc')
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();

        return $this->returnOkApi(null, $categories);
    }


    /**
     * 更新状态
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function updateStatus($id, Request $request)
    {
        $category = Category::query()->findOrFail($id);

        if ($category->pid == 0) {
            $path = $category->id . '%';
            $top_id = $category->id;
        } else {
            $path = $category->path . ',' . $category->id . '%';
            $top_id = $category->top_id;
        }

        try {

            DB::beginTransaction();

            $category->status = $request->input('status');
            $category->save();

            Category::query()
                ->where('top_id', $top_id)
                ->where('path', 'like', $path)
                ->update(['status' => $request->input('status')]);

            DB::commit();
            return $this->returnOkApi("更新成功");

        } catch (\Exception $exception) {
            DB::rollBack();
            return $this->returnErrorApi("更新失败");
        }
    }
}
