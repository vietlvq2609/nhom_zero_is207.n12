<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_methods')->insert([
            [
                'name' => 'Giao hàng nhanh',
                'price' => 20000
            ],
            [
                'name' => 'Giao hàng tiết kiệm',
                'price' => 10000
            ]
        ]);
    }
}
