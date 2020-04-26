<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Exceptions\JsonValidatorException;
use App\Exceptions\WebValidatorException;
use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Permission;
use App\Modules\Admin\Models\Role;
use App\Modules\Admin\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class UsersController extends BaseController
{
    public $model = \App\Modules\Admin\Models\User::class;

    public $view_prefix_path = "admin::admin.";

    public $page_name = '用户';

    /**
     * 创建
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $roles = Role::query()->select('id', 'cn_name as name')->latest()->get();

        return view('admin::admin.user.create_or_edit', compact('roles'));
    }

    /**
     * 添加
     *
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws JsonValidatorException
     * @throws WebValidatorException
     */
    public function store(Request $request)
    {
        $this->validateData($request);

        try {
            DB::beginTransaction();

            $data = $this->getQuery()->fill($request->all());

            $data->save();

            $data->save();


            $data->syncRoles($request->input('roles'));
            DB::commit();
            return $this->returnOkApi();
        } catch (\Exception $exception) {
            DB::rollBack();
            report($exception);
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
        $show = User::query()->findOrFail($id);

        $user_has_roles = $show->roles()->pluck('id')->toArray();

        $roles = Role::query()->select('id', 'cn_name as name')->latest()->get();

        return view('admin::admin.user.create_or_edit', compact('show', 'user_has_roles', 'roles'));
    }

    /**
     * 更新
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     * @throws JsonValidatorException
     * @throws WebValidatorException
     */
    public function update($id, Request $request)
    {
        $this->validateData($request);

        $data = $this->getQuery()->findOrFail($id);

        if (empty($request->input('password'))) {
            $request->offsetUnset('password');
        }

        try {

            DB::beginTransaction();

            $data->fill($request->all());

            $data->save();


            $data->syncRoles($request->input('roles'));
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
     * 重置密码
     *
     * @param User $user
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function resetPassword($id)
    {
        $user = User::query()->findOrFail($id);

        $user->password = User::DEFAULT_PASSWORD;
        $user->save();

        return $this->returnOkApi();
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
                    'username' => 'required|string|min:2,max:20|unique:users,username',
                    'nickname' => 'required|string|min:2,max:20',
                    'id_card' => 'required|idcard|unique:users,id_card',
                    'email' => 'nullable|email|unique:users,email',
                    'mobile' => 'nullable|phone|unique:users,mobile',
                    'password' => 'required|string|min:6|max:20',
                    'roles' => 'nullable|array',
                ];
                break;
            case 'PUT':
                return [
                    'username' => 'required|string|min:2,max:20|unique:users,username,' . $request->route('user') . ',id',
                    'nickname' => 'required|string|min:2,max:20',
                    'id_card' => 'required|idcard|unique:users,id_card,' . $request->route('user') . ',id',
                    'email' => 'nullable|email|unique:users,email,' . $request->route('user') . ',id',
                    'mobile' => 'nullable|phone|unique:users,mobile,' . $request->route('user') . ',id',
                    'password' => 'nullable|string|min:6|max:20',
                    'roles' => 'nullable|array',
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
