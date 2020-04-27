<?php

namespace App\Modules\Admin\Database\Seeds;

use App\Modules\Admin\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => 'site',
            'cn_name' => '站点设置',
            'value' => [
                ['name' => '站点名称', 'field' => 'name', 'value' => '', 'type' => 'text'],
                ['name' => 'Logo', 'field' => 'logo', 'value' => '', 'type' => 'img'],
                ['name' => 'slogan', 'field' => 'slogan', 'value' => '', 'type' => 'img'],
                ['name' => '统计代码', 'field' => 'tongji', 'value' => '', 'type' => 'textarea'],
            ]
        ]);

        Setting::create([
            'cn_name' => '阿里oss',
            'name' => 'alioss',
            'value' => [
                ['name' => 'access_key', 'field' => 'access_key', 'value' => '', 'type' => 'text'],
                ['name' => 'secret_key', 'field' => 'secret_key', 'value' => '', 'type' => 'text'],
                ['name' => 'bucket', 'field' => 'bucket', 'value' => '', 'type' => 'text'],
                ['name' => 'endpoint', 'field' => 'endpoint', 'value' => '', 'type' => 'text'],
                ['name' => 'isCName', 'field' => 'isCName', 'value' => '', 'type' => 'radio', 'list' => [['id' => 0, 'name' => '否'], ['id' => 1, 'name' => '是']]],
            ]
        ]);

        Setting::create([
            'cn_name' => '阿里短信',
            'name' => 'alisms',
            'value' => [
                ['name' => 'access_key', 'field' => 'access_key', 'value' => '', 'type' => 'text'],
                ['name' => 'secret_key', 'field' => 'secret_key', 'value' => '', 'type' => 'text'],
                ['name' => '签名', 'field' => 'sign', 'value' => '', 'type' => 'text'],
                ['name' => '模板ID', 'field' => 'template', 'value' => '', 'type' => 'text'],
            ]
        ]);
    }
}
