<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "ZeroFood Admin",
            'email_address' => 'admin@gmail',
            "phone_number" => '123456789',
            'password' => '123456789'
        ]);

        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
