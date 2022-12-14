<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'email_address' => 'admin@gmail.com',
            'phone_number' => '123456789',
            'password' => Hash::make('123456789'),
            'avatar' => 'https://www.toponseek.com/blogs/wp-content/uploads/2022/11/admin-la-gi-1.jpg'
        ]);

        DB::table('user_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
        DB::table('shopping_carts')->insert([
            'user_id' => 1,
        ]);
    }
}
