<?php

namespace App\Modules\Admin\Database\Seeds;

use App\Modules\Admin\Models\CategoryGroup;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('categories')->delete();

        \DB::table('categories')->insert(array(
            0 =>
                array(
                    'id' => 6,
                    'pid' => 0,
                    'category_group_id' => 1,
                    'name' => 'xitongpeizhi',
                    'nickname' => '系统配置',
                    'flag' => '',
                    'image' => 'layui-icon layui-icon-set',
                    'keywords' => '',
                    'description' => '',
                    'weigh' => 0,
                    'status' => '1',
                    'value' => '{"param": "", "router": ""}',
                    'created_at' => '2020-04-27 14:27:42',
                    'updated_at' => '2020-04-27 14:27:42',
                    'deleted_at' => NULL,

                    'top_id' => 0,
                    'path' => NULL,
                    'level' => 1,
                ),
            1 =>
                array(
                    'id' => 7,
                    'pid' => 6,
                    'category_group_id' => 1,
                    'name' => 'basics',
                    'nickname' => '基础配置',
                    'flag' => '',
                    'image' => '',
                    'keywords' => '',
                    'description' => '',
                    'weigh' => 0,
                    'status' => '1',
                    'value' => '{"param": "", "router": "admin.settings.index"}',
                    'created_at' => NULL,
                    'updated_at' => '2020-04-27 14:27:42',
                    'deleted_at' => NULL,

                    'top_id' => 6,
                    'path' => '6',
                    'level' => 2,
                ),
            2 =>
                array(
                    'id' => 8,
                    'pid' => 6,
                    'category_group_id' => 1,
                    'name' => 'menu',
                    'nickname' => '目录配置',
                    'flag' => '',
                    'image' => '',
                    'keywords' => '',
                    'description' => '',
                    'weigh' => 0,
                    'status' => '1',
                    'value' => '{"param": "?type=menu", "router": "admin.categories.index"}',
                    'created_at' => NULL,
                    'updated_at' => '2020-04-27 14:27:42',
                    'deleted_at' => NULL,

                    'top_id' => 6,
                    'path' => '6',
                    'level' => 2,
                ),
            3 =>
                array(
                    'id' => 25,
                    'pid' => 6,
                    'category_group_id' => 1,
                    'name' => 'role',
                    'nickname' => '角色管理',
                    'flag' => '',
                    'image' => '',
                    'keywords' => '',
                    'description' => '',
                    'weigh' => 0,
                    'status' => '1',
                    'value' => '{"param": "", "router": "admin.roles.index"}',
                    'created_at' => NULL,
                    'updated_at' => '2020-04-27 14:27:42',
                    'deleted_at' => NULL,

                    'top_id' => 6,
                    'path' => '6',
                    'level' => 2,
                ),
            4 =>
                array(
                    'id' => 26,
                    'pid' => 6,
                    'category_group_id' => 1,
                    'name' => 'permission',
                    'nickname' => '权限管理',
                    'flag' => '',
                    'image' => '',
                    'keywords' => '',
                    'description' => '',
                    'weigh' => 0,
                    'status' => '1',
                    'value' => '{"param": "", "router": "admin.permissions.index"}',
                    'created_at' => NULL,
                    'updated_at' => '2020-04-27 14:27:42',
                    'deleted_at' => NULL,

                    'top_id' => 6,
                    'path' => '6',
                    'level' => 2,
                ),
            5 =>
                array(
                    'id' => 53,
                    'pid' => 6,
                    'category_group_id' => 1,
                    'name' => 'users',
                    'nickname' => '用户管理',
                    'flag' => '',
                    'image' => '',
                    'keywords' => '',
                    'description' => '',
                    'weigh' => 0,
                    'status' => '1',
                    'value' => '{"param": "", "router": "admin.users.index"}',
                    'created_at' => NULL,
                    'updated_at' => '2020-04-27 14:27:42',
                    'deleted_at' => NULL,

                    'top_id' => 6,
                    'path' => '6',
                    'level' => 2,
                ),

        ));
    }
}
