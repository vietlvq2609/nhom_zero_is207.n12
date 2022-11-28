<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product_category;
use App\Models\Variation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            OrderStatusSeeder::class,
            ShippingMethodSeeder::class,
            PromotionSeeder::class,
            CountrySeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            ProductItemSeeder::class,
            VariationSeeder::class,
            VariationOptionSeeder::class,
            ProductConfigurationSeeder::class,
            AdminSeeder::class,
            PaymentTypeSeeder::class,
        ]);
    }
}
