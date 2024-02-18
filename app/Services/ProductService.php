<?php

namespace App\Services;

use App\Models\Product;

class ProductService implements ProductInterface
{

    /**
     * Get all products from the database
     *
     * @return mixed
     */
    public function getAllProducts(): mixed
    {
        return Product::orderBy('id')->paginate(12);
    }
}
