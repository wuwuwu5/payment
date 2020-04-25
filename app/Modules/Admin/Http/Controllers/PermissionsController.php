<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PermissionsController extends BaseController
{
    public $model = Permission::class;

    public $view_prefix_path = "admin::admin.";

    public $page_name = '权限';

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

        return view('admin::admin.permission.create_or_edit', compact( 'permissions'));
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
