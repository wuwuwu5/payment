<?php

namespace App\Modules\Admin\Database\Seeds;

use App\Modules\Admin\Models\CategoryGroup;
use Illuminate\Database\Seeder;

class CategoryGroupSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 目录管理
        CategoryGroup::create([
            'title' => '目录管理',
            'name' => 'menu',
            'depth' => 2,
        ]);
        // 前端栏目管理
        CategoryGroup::create([
            'title' => '前端栏目管理',
            'name' => 'front_column',
            'depth' => 2,
        ]);
        // 文章来源
        CategoryGroup::create([
            'title' => '文章来源',
            'name' => 'article_source',
            'depth' => 1,
        ]);
        // 文章分类
        CategoryGroup::create([
            'title' => '文章分类',
            'name' => 'article',
            'depth' => 2,
        ]);
        // 标签
        CategoryGroup::create([
            'title' => '标签',
            'name' => 'tag',
            'depth' => 2,
        ]);
        // 轮播图
        CategoryGroup::create([
            'title' => '轮播图',
            'name' => 'slides',
            'depth' => 1,
        ]);
    }
}
