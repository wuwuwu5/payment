<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Category;
use App\Modules\Admin\Models\CategoryGroup;
use Illuminate\Validation\Rule;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return $this->indexJson($request);
        }

        $this->setCreateUrl('admin.categories.create', ['type' => $request->input('type')]);
        $this->setStoreUrl('admin.categories.store', ['type' => $request->input('type')]);
        $this->page_name = data_get(CategoryGroup::NAMES, $request->input('type', -1), '');

        return $this->display();
    }

    /**
     * 首页数据
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

        $categories = $this->setDataItemUrl($categories);

        return $this->returnOkApi(null, $categories);
    }

    /**
     * 创建
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create(Request $request)
    {
        $name = $request->input('type');

        if (empty($name)) {
            return abort(404);
        }

        $category_group = CategoryGroup::query()->where(compact('name'))->firstOrFail();

        return $this->display(null, compact('category_group'));
    }

    /**
     * 保存
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\JsonValidatorException
     * @throws \App\Exceptions\WebValidatorException
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        $parent = null;
        $top_id = 0;
        $path = null;

        // 可添加的最大层级
        $depth = $request->input('category_group')->depth;

        if (($pid = $request->input('pid')) > 0) {
            $parent = Category::query()->findOrFail($pid);

            if ($parent->pid != 0) {
                $path = $parent->path . ',' . $parent->id;
                $top_id = $parent->top_id;
            } else {
                $top_id = $path = $parent->id;
            }
        }

        // 超出层级
        if (count(array_filter(explode(',', $path))) >= $depth) {
            return $this->returnErrorApi('层级最多可添加' . $depth . '层!');
        }

        // 创建
        $category = resolve(Category::class);

        $category->fill($request->all());
        $category->top_id = $top_id;
        $category->path = $path;
        $category->save();

        return $this->returnOkApi();
    }

    /**
     * 修改
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, Request $request)
    {
        $category = Category::query()->with('categoryGroup')->where(compact('id'))->firstOrFail();

        return $this->display(null, compact('category'));
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

    /**
     * 验证规则
     *
     * @param Request $request
     * @return array
     */
    public function rules($request): array
    {
        $name = $request->input('type');

        // 查询父类
        $category_group = CategoryGroup::query()
            ->where(compact('name'))
            ->where('id', $request->input('category_group_id'))
            ->firstOrFail();

        $request->offsetSet('category_group', $category_group);

        switch ($request->method()) {
            case 'POST':
                return [
                    'type' => 'required',
                    'nickname' => [
                        'required',
                        'min:2',
                        'max:30',
                        Rule::unique('categories')->where(function ($q) use ($category_group) {
                            $q->where('category_group_id', $category_group->id);
                        }),
                    ],
                    'name' => [
                        'required',
                        'min:2',
                        'max:30',
                        Rule::unique('categories')->where(function ($q) use ($category_group) {
                            $q->where('category_group_id', $category_group->id);
                        }),
                    ],
                    'pid' => [function ($attr, $value, $fail) use ($name) {
                        if ($value < 0) {
                            return $fail('父级选择错误');
                        }

                        if ($value != 0) {
                            $mark = Category::query()->where('id', $value)->exists();

                            if (!$mark) {
                                return $fail('父级选择错误');
                            }
                        }

                        return true;
                    }],
                ];
                break;
            case 'PUT':
                return [
                    'type' => 'required',
                    'nickname' => ['required', Rule::unique('categories')->where(function ($q) use ($category_group, $request) {
                        $q->where('category_group_id', $category_group->id)->where('id', '<>', $request->route('category'));
                    })],
                    'name' => [
                        'required',
                        'min:2',
                        'max:30',
                        Rule::unique('categories')->where(function ($q) use ($category_group, $request) {
                            $q->where('category_group_id', $category_group->id)->where('id', '<>', $request->route('category'));
                        }),
                    ],
                    'pid' => [function ($attr, $value, $fail) use ($name, $request) {
                        if ($value < 0) {
                            return $fail('父级选择错误');
                        }

                        if ($value == $request->route('category')) {
                            return $fail('父级选择错误');
                        }

                        if ($value != 0) {
                            $mark = Category::query()->where('id', $value)->exists();

                            if (!$mark) {
                                return $fail('父级选择错误');
                            }
                        }

                        return true;
                    }],
                ];
                break;
        }
    }
}
