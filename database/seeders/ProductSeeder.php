<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Oversized Hoodie',
            'price' => 49.9,
            'description' => 'Soft cotton oversized hoodie for everyday comfort.',
            'quantity' => 10,
            'image' => 'storage/images/oversized-hoodie.jpg',
            ]);

        Product::create([
            'name' => 'Classic Crewneck Sweatshirt',
            'price' => 39.9,
            'description' => 'Warm fleece crewneck sweatshirt with a relaxed fit.',
            'quantity' => 22,
            'image' => 'storage/images/classic-crewneck.jpg',
            ]);

        Product::create([
            'name' => 'Basic T-Shirt',
            'price' => 19.9,
            'description' => 'Everyday premium cotton t-shirt.',
            'quantity' => 75,
            'image' => 'storage/images/basic-tshirt.jpg',
            ]);

        Product::create([
            'name' => 'Polo Shirt',
            'price' => 34.9,
            'description' => 'Classic polo shirt with breathable fabric.',
            'quantity' => 18,
            'image' => 'storage/images/polo-shirt.jpg',
            ]);

        Product::create([
            'name' => 'Cargo Pants',
            'price' => 54.9,
            'description' => 'Durable cargo pants with multiple utility pockets.',
            'quantity' => 0,
            'image' => 'storage/images/cargo-pants.jpg',
        ]);

    }
}
