<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variation_options')->insert([
            [
                'value' => 'Nhỏ',
                'variation_id' => 1
            ],
            [
                'value' => 'Lớn',
                'variation_id' => 1
            ],
            [
                'value' => 'Không topping',
                'variation_id' => 2
            ],
            [
                'value' => 'Trân châu trắng',
                'variation_id' => 2
            ],
        ]);
    }
}
