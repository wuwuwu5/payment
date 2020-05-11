<?php

namespace App\Modules\Admin\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Modules\Admin\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends BaseController
{
    public $model = \App\Modules\Admin\Models\Setting::class;

    public $view_prefix_path = "admin::admin.";

    /**
     * 首页
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $settings = Setting::query()->latest()->get();

        return $this->display(null, compact('settings'));
    }

    /**
     * 更新
     *
     * @param $id
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $setting = Setting::query()->findOrFail($id);

        // 获取value数据
        $value = $setting->value;

        foreach ($value as $key => $item) {
            $item['value'] = $request->input($item['field']);
            $value[$key] = $item;
        }


        $setting->value = $value;
        $setting->save();

        return $this->returnOkApi();
    }
}
