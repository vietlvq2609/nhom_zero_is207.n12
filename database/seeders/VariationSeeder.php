<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VariationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('variations')->insert([
            [
                'name' => 'Kích thước',
                'category_id' => 1
            ],
            [
                'name' => 'Topping',
                'category_id' => 2
            ],
        ]);
    }
}
