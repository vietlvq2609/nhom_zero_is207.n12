<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            [
                'value' => 'Thanh toán khi nhận hàng'
            ],
            [
                'value' => 'Chuyển khoản ngân hàng'
            ],
            [
                'value' => 'Ví điện tử'
            ]
        ]);
    }
}
