<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_items')->insert([
            [
                'product_id' => 1,
                'qty_in_stock' => 20,
                'price' => 120000
            ],
            [
                'product_id' => 1,
                'qty_in_stock' => 10,
                'price' => 150000
            ],
            [
                'product_id' => 2,
                'qty_in_stock' => 10,
                'price' => 80000
            ],
            [
                'product_id' => 2,
                'qty_in_stock' => 8,
                'price' => 110000
            ],
            [
                'product_id' => 3,
                'qty_in_stock' => 4,
                'price' => 100000
            ],
            [
                'product_id' => 3,
                'qty_in_stock' => 7,
                'price' => 130000
            ],
            [
                'product_id' => 4,
                'qty_in_stock' => 9,
                'price' => 90000
            ],
            [
                'product_id' => 4,
                'qty_in_stock' => 12,
                'price' => 120000
            ],
            [
                'product_id' => 5,
                'qty_in_stock' => 23,
                'price' => 100000
            ],
            [
                'product_id' => 5,
                'qty_in_stock' => 14,
                'price' => 110000
            ],
            [
                'product_id' => 6,
                'qty_in_stock' => 15,
                'price' => 140000
            ],
            [
                'product_id' => 6,
                'qty_in_stock' => 5,
                'price' => 190000
            ],
        ]);
    }
}
