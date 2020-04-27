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
    }
}
