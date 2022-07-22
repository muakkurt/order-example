<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;


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
            DiscountSeeder::class,
            CustomerSeeder::class,
            ProductSeeder::class
        ]);
    }
}
