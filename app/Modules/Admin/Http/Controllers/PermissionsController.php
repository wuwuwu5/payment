<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PermissionsController extends BaseController
{
    public $model = Permission::class;

    public $view_prefix_path = "admin::admin.";

    public $page_name = '权限';


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

        $parent_id = $request->input('parent_id');

        $parent = null;
        $path = null;
        $top_id = 0;

        if (!empty($parent_id)) {
            $parent = $this->getQuery()->findOrFail($parent_id);

            if ($parent->parent_id == 0) {
                $top_id = $parent->id;
                $path = $parent->id;
            } else {
                $top_id = $parent->top_id;
                $path = $parent->path . ',' . $parent->id;
            }
        }

        Permission::create([
            'path' => $path,
            'top_id' => $top_id,
            'parent_id' => $parent_id,
            'icon' => $request->input('icon'),
            'name' => $request->input('name'),
            'cn_name' => $request->input('cn_name'),
            'guard_name' => 'admin',
        ]);

        return $this->returnOkApi();
    }


    /**
     * 修改
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function edit($id, Request $request)
    {
        $show = Permission::query()->findOrFail($id);

        $permissions = Permission::query()->where('id', '>', $id)->orWhere('id', '<', $id)->latest()->get()->toArray();

        return view('admin::admin.permission.create_or_edit', compact('show', 'permissions'));
    }

    /**
     * 添加
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|void
     */
    public function create(Request $request)
    {
        $permissions = Permission::query()->latest()->get()->toArray();

        return view('admin::admin.permission.create_or_edit', compact('permissions'));
    }

    /**
     * 删除
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function destroy($id, Request $request)
    {
        $permission = Permission::query()->findOrFail($id);

        try {

            DB::beginTransaction();

            // 路径
            $path = $permission->path . ',' . $permission->id;
            // 顶级ID
            $top_id = $permission->top_id;

            // 路径为空表示为顶级元素
            if (empty($permission->path)) {
                $path = $permission->id;
                $top_id = $permission->id;
            }

            // 删除
            Permission::query()->where('top_id', $top_id)->where('path', 'like', $path . '%')->delete();

            $permission->delete();

            DB::commit();

            return $this->returnOkApi();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            return $this->returnErrorApi();
        }
    }


    /**
     * 参数验证规则
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request): array
    {
        switch ($request->method()) {
            case 'POST':
                return [
                    'cn_name' => [
                        'required',
                        'string',
                        Rule::unique('permissions', 'cn_name'),
                    ],
                    'parent_id' => ['required', function ($attr, $value, $fail) {
                        if ($value < 0) {
                            return $fail('父级选择错误');
                        }

                        if ($value > 0) {
                            if (!Permission::query()->where('id', $value)->exists()) {
                                return $fail('父级选择错误');
                            }
                        }
                    }
                    ],
                    'name' => [
                        'required',
                        'string',
                        Rule::unique('permissions', 'name'),
                    ],
                ];
                break;
            case 'PUT':
                return [
                    'cn_name' => [
                        'required',
                        'string',
                        Rule::unique('permissions', 'cn_name')->where(function ($q) use ($request) {
                            $q->where('id', '<>', $request->route('permission'));
                        })
                    ],
                    'parent_id' => ['required', function ($attr, $value, $fail) {
                        if ($value < 0) {
                            return $fail('父级选择错误');
                        }

                        if ($value > 0) {
                            if (!Permission::query()->where('id', $value)->exists()) {
                                return $fail('父级选择错误');
                            }
                        }
                    }],
                    'name' => [
                        'required',
                        'string',
                        Rule::unique('permissions', 'name')->where(function ($q) use ($request) {
                            $q->where('id', '<>', $request->route('permission'));
                        })
                    ],
                ];
                break;
        }
        return [];
    }

    /**
     * 字段
     *
     * @return array
     */
    public function customAttributes(): array
    {
        return ['cn_name' => '名称', 'name' => '路由地址', 'parent_id' => '父级'];
    }
}
