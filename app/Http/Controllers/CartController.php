<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private CartInterface $cartService;

    public function __construct(CartInterface $cartService)
    {
        $this->cartService = $cartService;
    }

    /**
     * Displaying a list of products in the cart
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        $userId = Auth::user()->id;
        $order = $this->cartService->getOrder($userId);

        return view('cart.show', compact('order'));
    }

    /**
     * Add product in cart
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function add(Product $product): RedirectResponse
    {
        $userId = Auth::user()->id;
        $order = $this->cartService->getOrder($userId);

        if (is_null($order)) {
            $order = $this->cartService->createOrder($userId);
        }

        $this->cartService->addProduct($order, $product);

        return redirect()->route('products.index');
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function remove(Product $product): RedirectResponse
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
