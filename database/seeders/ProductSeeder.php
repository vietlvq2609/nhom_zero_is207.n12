<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Pizza Gà',
                'category_id' => 3,
                'description' => 'Pizza Gà thơm ngon giòn rụm! Mời bạn ăn nha',
                'product_image' => 'https://cdn.tgdd.vn/2020/09/CookProduct/83-1200x676.jpg',
            ],
            [
                'name' => 'Pizza Hải sản',
                'category_id' => 3,
                'description' => 'Pizza làm từ hải sản tự nhiên, ăn vào là mê ngay!',
                'product_image' => 'https://cdn.tgdd.vn/2020/09/CookProduct/1200bzhspm-1200x676.jpg',
            ],
            [
                'name' => 'Salad Trộn Dầu Giấm',
                'category_id' => 4,
                'description' => 'Rau với sốt dầu giấm',
                'product_image' => 'https://cdn.tgdd.vn/Files/2021/08/06/1373466/huong-dan-lam-mon-salad-dau-giam-thom-ngon-bo-duong-de-lam-tai-nha-202201081510043817.jpeg',
            ],
            [
                'name' => 'Salad Đặc Sắc',
                'category_id' => 4,
                'description' => 'Bông cải xanh, búp cải tím, táo, xà lách, trứng… và sốt Salad đặc biệt',
                'product_image' => 'https://cdn.tgdd.vn/2021/04/content/r8-800x500.jpg',
            ],
            [
                'name' => 'Mỳ Ý Cay Hải Sản',
                'category_id' => 5,
                'description' => 'Mỳ Ý rán với các loại hải sản tươi ngon cùng ớt và tỏi',
                'product_image' => 'https://cdn.tgdd.vn/Files/2020/05/04/1253396/cach-lam-mi-y-hai-san-don-gian-thom-ngon-dam-da-ngay-tai-nha-5.png',
            ],
            [
                'name' => 'Mỳ Ý Tôm Sốt Kem Cà Chua',
                'category_id' => 5,
                'description' => 'Sự tươi ngon của tôm kết hợp với sốt kem cà chua',
                'product_image' => 'https://cdn.tgdd.vn/2020/10/CookRecipe/Avatar/cach-lam-mi-y-tom-sot-kem-oc-cho-thumbnail.jpg',
            ],
        ]);
    }
}
