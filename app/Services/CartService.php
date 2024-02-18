<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class CartService implements CartInterface
{
    /**
     * Get the first order with status 0 for the given user.
     *
     * @param int $userId
     * @return mixed
     */

    public function getOrder(int $userId)
    {
        return Order::where([
            ['status', '=', 0],
            ['user_id', '=', $userId],
        ])->first();
    }

    /**
     * Create new order for the given user
     *
     * @param int $userId
     * @return mixed
     */
    public function createOrder(int $userId)
    {
        return Order::create([
            'user_id' => $userId,
        ]);
    }

    /**
     * Add product to order
     *
     * @param Order $order
     * @param Product $product
     * @return void
     */
    public function addProduct(Order $order, Product $product): void
    {
        if ($order->products->contains($product->id)) {
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        } else {
            $order->products()->attach($product->id);
        }
    }

    /**
     * Remove product from order
     *
     * @param Order $order
     * @param Product $product
     * @return void
     */
    public function removeProduct(Order $order, Product $product): void
    {
        if ($order->products->contains($product->id)) {
            $pivotRow = $order->products()->where('product_id', $product->id)->first()->pivot;
            if ($pivotRow->count < 2) {
                $order->products()->detach($product->id);
            } else {
                $pivotRow->count--;
                $pivotRow->update();
            }
        }
    }
}
