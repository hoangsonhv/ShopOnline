<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
//        DB::table("admins")->insert([
//            "name"=>"Administrator",
//            "email"=>"admin@gmail.com",
//            "password"=>bcrypt("11111111"),
//        ]);
        DB::table("staffs")->insert([
            "name"=>"Hoàng Văn Sơn",
            "address"=>"Xuân Đỉnh",
            "email"=>"sssss@gmail.com",
            "gender"=>"Nam",
            "phone_number"=>"0968555197",
            "password"=>bcrypt("11111111"),
        ]);
    }
}
