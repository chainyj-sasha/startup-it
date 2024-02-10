<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;

interface CartInterface
{
    public function getOrder(int $userId);

    public function createOrder(int $userId);

    public function addProduct(Order $order, Product $product): void;

    public function removeProduct(Order $order, Product $product): void;
}
