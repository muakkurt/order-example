<?php

namespace App\Services\Product;

use App\Models\Product;

class ProductService{

    public function decreaseProductStock(Product $product, int $value = 1): Product
    {
        $product->update([
           'stock' => $product->stock - $value
        ]);

        return $product;
    }

}