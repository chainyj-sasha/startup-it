<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Services\CartInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private CartInterface $cartService;

    public function __construct(CartInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $userId = Auth::user()->id;
        $order = $this->cartService->getOrder($userId);

        return view('cart.show', compact('order'));
    }

    public function add(Product $product)
    {
        $userId = Auth::user()->id;
        $order = $this->cartService->getOrder($userId);

        if (is_null($order)) {
            $order = $this->cartService->createOrder($userId);
        }

        $this->cartService->addProduct($order, $product);

        return redirect()->route('products.index');
    }

    public function remove(Product $product)
    {
        $userId = Auth::user()->id;
        $order = $this->cartService->getOrder($userId);

        if (is_null($order)) {
            return redirect()->route('cart.index');
        }

        $this->cartService->removeProduct($order, $product);

        return redirect()->route('products.index');
    }
}
