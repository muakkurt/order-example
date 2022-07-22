<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = Http::get('https://raw.githubusercontent.com/ideasoft/se-take-home-assessment/master/example-data/products.json');

        $products = json_decode($products->body(), true);

        foreach($products as $product){
            Product::create([
                'id' => $product['id'] ?? Product::latest()->first()->id,
                'name' => $product['name'] ?? null,
                'category_id' => $product['category'] ?? null,
                'price' => $product['price'] ?? null,
                'stock' => $product['stock'] ?? null,
            ]);
        }
    }
}
