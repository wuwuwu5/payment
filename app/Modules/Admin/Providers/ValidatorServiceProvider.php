<?php

namespace App\Modules\Admin\Providers;

use App\Modules\Admin\Rules\Parses\IdCardParse;
use App\Modules\Admin\Rules\Parses\PhoneParse;
use Caffeinated\Modules\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Blade;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the module services.
     *
     * @return void
     */
    public function boot()
    {

        Validator::extend('idcard', function ($attribute, $value, $parameters, $validator) {
            return IdCardParse::passes($value);
        });

        Validator::replacer('idcard', function ($message, $attribute, $rule, $parameters) {
            return '无效的身份证号码';
        });

        Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return PhoneParse::passes($value);
        });

        Validator::replacer('phone', function ($message, $attribute, $rule, $parameters) {
            return '无效的手机号';
        });
    }

    /**
     * Register the module services.
     *
     * @return void
     */
    public function register()
    {
    }
}
