<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Exceptions\JsonValidatorException;
use App\Exceptions\WebValidatorException;
use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\User;
use Illuminate\Http\Request;

class UsersController extends BaseController
{
    public $model = \App\Modules\Admin\Models\User::class;

    public $view_prefix_path = "admin::admin.";


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

        $data->fill($request->all());

        $data->save();

        return $this->returnOkApi();
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
}
