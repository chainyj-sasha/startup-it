<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    private function addProduct(int $countProduct): void
    {
        Product::create([
            'title' => 'Шоссейный велосипед BMC ' . $countProduct,
            'image' => 'pic-1.webp',
            'price' => rand(1000, 10000),
        ]);

    }
    public function run(): void
    {
        $countProduct = 0;

        while ($countProduct <= 36) {
            $this->addProduct($countProduct);
            $countProduct += 1;
        }
    }
}
