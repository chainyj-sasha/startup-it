<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

class CartService implements CartInterface
{

    public function getOrder(int $userId)
    {
        return Order::where([
            ['status', '=', 0],
            ['user_id', '=', $userId],
        ])->first();
    }

    public function createOrder(int $userId)
    {
        return Order::create([
            'user_id' => $userId,
        ]);
    }

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
