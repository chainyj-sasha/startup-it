<?php

namespace App\Http\Controllers;

use App\Services\ProductInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    private ProductInterface $productService;


    public function __construct(ProductInterface $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Displaying a list of all products
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $products = $this->productService->getAllProducts();

        return view('products.index', compact('products'));
    }
}
