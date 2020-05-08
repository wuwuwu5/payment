<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\CategoryGroup;
use App\Modules\Admin\Models\Slide;
use Illuminate\Http\Request;

class SlidesController extends BaseController
{
    public $model = \App\Modules\Admin\Models\Slide::class;

    public $view_prefix_path = "admin::admin.";

    public $page_name = '轮播图';

    /**
     * 首页数据
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $category_group = CategoryGroup::query()->where('name', CategoryGroup::SLIDES)->first();

        if (empty($category_group)) {
            return $this->display(null, ['category_group' => null, 'categories' => []]);
        }

        $categories = $category_group
            ->categories()
            ->with(['slides' => function ($query) {
                $query
                    ->orderBy('sort', 'desc')
                    ->orderBy('created_at', 'desc');
            }])
            ->orderBy('weigh', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($categories as $category) {
            $category->slides = $this->setDataItemUrl($category->slides);
        }

        return $this->display(null, ['category_group' => $category_group, 'categories' => $categories]);
    }


    /**
     * 更新状态
     *
     * @param Slide $slide
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function publish(Slide $slide, Request $request)
    {
        $this->authorize('update', $slide);

        $publish = (bool)$request->input('publish');

        if ($slide->is_published == $publish) {
            return $this->returnApi(200, '更新成功');
        }

        $slide->is_published = $publish;
        $slide->save();

        return $this->returnApi(200, '更新成功');
    }


    /**
     * list event url
     *
     * @param $data
     * @return mixed
     */
    public function setDataItemUrl($data)
    {
        $params = \request()->route()->parameters() ?? [];

        foreach ($data as $item) {
            $item->edit_url = $this->getEditUrl(array_merge($params, [$item->id]), true);
            $item->update_url = $this->getUpdateUrl(array_merge($params, [$item->id]), true);
            $item->destory_url = $this->getDestroyUrl(array_merge($params, [$item->id]), true);
            $item->publish_url = $this->checkRoute('admin.slides.publish', [$item->id]);
        }

        return $data;
    }
}
