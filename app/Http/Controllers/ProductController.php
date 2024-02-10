<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductInterface $productService;

    public function __construct(ProductInterface $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts();

        return view('products.index', compact('products'));
    }
}
