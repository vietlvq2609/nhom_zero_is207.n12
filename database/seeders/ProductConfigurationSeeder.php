<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_configurations')->insert([
            [
                'product_item_id' => 1,
                'variation_option_id' => 1
            ],
            [
                'product_item_id' => 2,
                'variation_option_id' => 2
            ],
            [
                'product_item_id' => 3,
                'variation_option_id' => 1
            ],
            [
                'product_item_id' => 4,
                'variation_option_id' => 2
            ],
            [
                'product_item_id' => 5,
                'variation_option_id' => 1
            ],
            [
                'product_item_id' => 6,
                'variation_option_id' => 2
            ],
            [
                'product_item_id' => 7,
                'variation_option_id' => 1
            ],
            [
                'product_item_id' => 8,
                'variation_option_id' => 2
            ],
            [
                'product_item_id' => 9,
                'variation_option_id' => 1
            ],
            [
                'product_item_id' => 10,
                'variation_option_id' => 2
            ],
            [
                'product_item_id' => 11,
                'variation_option_id' => 1
            ],
            [
                'product_item_id' => 12,
                'variation_option_id' => 2
            ],
        ]);
    }
}
