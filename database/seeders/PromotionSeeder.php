<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('promotions')->insert([
            [
                'name' => 'Mừng 20-11',
                'description' => 'Giảm giá 20% cho các sản phẩm đồ uống nhân dịp ngày Nhà giáo Việt Nam!',
                'discount_rate' => 20,
                'start_date' => '19/11/2022',
                'end_date' => '21/11/2022',
            ],
            [
                'name' => 'Chào mừng khai trương',
                'description' => 'Giảm giá 50% tất cả sản phẩm nhân dịp khai trương chi nhánh mới của ZeroFood',
                'discount_rate' => 50,
                'start_date' => '14/10/2022',
                'end_date' => '20/10/2022',
            ],
        ]);
    }
}
