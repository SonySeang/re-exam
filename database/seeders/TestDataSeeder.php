<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Shop;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create shop owner user
        $shopOwner = User::create([
            'name' => 'Shop Owner',
            'email' => 'shop@example.com',
            'password' => Hash::make('password'),
            'role' => 'shop_owner',
        ]);

        // Create shop
        $shop = Shop::create([
            'user_id' => $shopOwner->id,
            'name' => 'Tech Store',
            'description' => 'Best electronics and gadgets',
        ]);

        // Create products
        $products = [
            ['name' => 'iPhone 15', 'description' => 'Latest iPhone model', 'price' => 999.99, 'stock' => 50],
            ['name' => 'MacBook Pro', 'description' => 'Professional laptop', 'price' => 1999.99, 'stock' => 25],
            ['name' => 'AirPods Pro', 'description' => 'Wireless earbuds', 'price' => 249.99, 'stock' => 100],
            ['name' => 'iPad Air', 'description' => 'Tablet for work and play', 'price' => 599.99, 'stock' => 75],
            ['name' => 'Apple Watch', 'description' => 'Smart watch', 'price' => 399.99, 'stock' => 60],
        ];

        foreach ($products as $productData) {
            Product::create([
                'shop_id' => $shop->id,
                'name' => $productData['name'],
                'description' => $productData['description'],
                'price' => $productData['price'],
                'stock' => $productData['stock'],
            ]);
        }

        // Create regular user
        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}