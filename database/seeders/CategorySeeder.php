<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'category_name' => 'Đồ ăn',
                'parent_category_id' => 1,
                'category_image' => null
            ],
            [
                'category_name' => 'Đồ uống',
                'parent_category_id' => 2,
                'category_image' => "https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2022/5/9/nuoc-chanh1-16521101548871034599330.jpg"
            ],
            [
                'category_name' => 'Pizza',
                'parent_category_id' => 1,
                'category_image' => "https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Eq_it-na_pizza-margherita_sep2005_sml.jpg/800px-Eq_it-na_pizza-margherita_sep2005_sml.jpg",
            ],
            [
                'category_name' => 'Salad',
                'parent_category_id' => 1,
                'category_image' => "https://images.immediate.co.uk/production/volatile/sites/30/2014/05/Epic-summer-salad-hub-2646e6e.jpg"
            ],
            [
                'category_name' => 'Mì Ý',
                'parent_category_id' => 1,
                'category_image' => 'https://i1-giadinh.vnecdn.net/2022/04/20/Bc99-1650439459-8855-1650439557.jpg?w=0&h=0&q=100&dpr=2&fit=crop&s=iatvSHr9fwWEuRdqPKJHRg'
            ],
            [
                'category_name' => 'Tráng miệng',
                'parent_category_id' => 1,
                'category_image' => "https://suckhoedoisong.qltns.mediacdn.vn/Images/phamhiep/2016/08/09/1_11.jpg"
            ],
            [
                'category_name' => 'Gà giòn',
                'parent_category_id' => 1,
                'category_image' => "https://cdn.tgdd.vn/2021/07/CookProduct/9-1200x676.jpg"
            ],
        ]);
    }
}
