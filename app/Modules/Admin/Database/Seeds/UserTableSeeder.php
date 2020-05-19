<?php

namespace App\Modules\Admin\Database\Seeds;

use App\Modules\Admin\Models\CategoryGroup;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \DB::table('users')->where('id','1')->first();
        if(empty($users)){
            \DB::table('users')->insert(
                [
                    'id' => '1',
                    'guid' => '',
                    'username'=> 'admin',
                    'nickname' => 'admin',
                    'password' =>  bcrypt('123456'),
                    'is_admin' => 1,
                    'locked' => 0
                ]
            );
        }
    }
}
