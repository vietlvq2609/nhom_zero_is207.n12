<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_statuses')->insert([
            'status' => 'Đang giao'
        ]);
        DB::table('order_statuses')->insert([
            'status' => 'Giao thành công'
        ]);
        DB::table('order_statuses')->insert([
            'status' => 'Đang xử lý'
        ]);
    }
}
