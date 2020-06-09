<?php


namespace App\Modules\Admin\Database\Seeds;

use Illuminate\Database\Seeder;

class AdminDatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        $this->call(SettingSeed::class);
        $this->call(CategoryGroupSeed::class);
        $this->call(CategoriesTableSeeder::class);
//        $this->call(UserTableSeeder::class);
    }
}
