<?php

namespace App\Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Permission;
use App\Modules\Admin\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use function foo\func;

class RolesController extends BaseController
{
    public $model = \App\Modules\Admin\Models\Role::class;

    public $view_prefix_path = "admin::admin.";

    public $page_name = '角色';

    /**
     * 创建
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $permissions = Permission::query()->latest()->get()->toArray();

        return view('admin::admin.role.create_or_edit', compact('permissions'));
    }


    /**
     * 角色保存
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\JsonValidatorException
     * @throws \App\Exceptions\WebValidatorException
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        try {

            DB::beginTransaction();

            $show = Role::create([
                'guard_name' => 'admin',
                'mark' => $request->input('mark'),
                'name' => $request->input('name'),
                'cn_name' => $request->input('cn_name'),
            ]);

            $show->syncPermissions($request->input('permissions'));

            DB::commit();
            return $this->returnOkApi();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
            dd($exception);
            return $this->returnErrorApi();
        }
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
        $show = Role::query()->findOrFail($id);

        $permissions = Permission::query()->latest()->get()->toArray();

        $role_has_permissions = $show->permissions()->pluck('id')->flip();

        return view('admin::admin.role.create_or_edit', compact('show', 'permissions', 'role_has_permissions'));
    }

    /**
     * 更新
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\JsonValidatorException
     * @throws \App\Exceptions\WebValidatorException
     */
    public function update($id, Request $request)
    {
        $this->validateData($request);

        $show = Role::query()->findOrFail($id);

        try {
            DB::beginTransaction();

            $show->cn_name = $request->input('cn_name');
            $show->mark = $request->input('mark');
            $show->name = $request->input('name');
            $show->save();

            $show->syncPermissions($request->input('permissions'));

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
                        Rule::unique('roles', 'cn_name'),
                    ],
                    'name' => [
                        'required',
                        'string',
                        Rule::unique('roles', 'name'),
                    ],
                    'mark' => 'nullable|string',
                    'permissions' => 'nullable|array',
                ];
                break;
            case 'PUT':
                return [
                    'cn_name' => [
                        'required',
                        'string',
                        Rule::unique('roles', 'cn_name')->where(function ($q) use ($request) {
                            $id = $request->route('role');
                            $q->where('id', '<>', $id);
                        })
                    ],
                    'name' => [
                        'required',
                        'string',
                        Rule::unique('roles', 'name')->where(function ($q) use ($request) {
                            $id = $request->route('role');
                            $q->where('id', '<>', $id);
                        })
                    ],
                    'mark' => 'nullable|string',
                    'permissions' => 'nullable|array',
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
        return [
            'cn_name' => '角色名称',
            'name' => '标识符'
        ];
    }

}
