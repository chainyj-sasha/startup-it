<?php

namespace App\Services;

use App\Models\Product;

class ProductService implements ProductInterface
{

    public function getAllProducts()
    {
        return Product::orderBy('id')->paginate(12);
    }
}
