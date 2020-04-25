<?php

namespace App\Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormBuilder as Form;

class FormGroupServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 普通文本
        Form::component('LayText','admin::components.form.laytext', ['params']);
        // 单选
        Form::component('LayRadio','admin::components.form.layradio', ['params']);
        // 复选框
        Form::component('LayCheckbox','admin::components.form.laycheckbox', ['params']);
        // 日期选择
        Form::component('LayDate','admin::components.form.laydate', ['params']);
        // 颜色选择器
        Form::component('Layolor','admin::components.form.laycolor', ['params']);
        // 文本域
        Form::component('LayTextArea','admin::components.form.laytextarea', ['params']);
        // 下拉选择
        Form::component('LaySelect','admin::components.form.layselect', ['params']);
        // 提交
        Form::component('LaySubmit','admin::components.form.laysubmit', ['params']);
        // 滑动
        Form::component('LaySlider','admin::components.form.layslider', ['params']);
        // 文件上传
        Form::component('LayFile','admin::components.form.layfile', ['params']);

        // icon选择
        Form::component('LayIcon','admin::components.form.layicon', ['params']);

        // 编辑器 富文本
        Form::component('LayEdit','admin::components.form.layedit', ['params']);

        // 上传IMG
        Form::component('LayImg','admin::components.form.layupimg', ['params']);

        // 编辑器 富文本
        Form::component('LayTinymce','admin::components.form.laytinymce', ['params']);
        Form::component('LayTinymceJs','admin::components.form.laytinymce_js', ['params']);
    }
}
