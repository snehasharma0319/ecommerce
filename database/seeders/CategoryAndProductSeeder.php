<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class CategoryAndProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create categories
        $categories = [
            ['name' => 'Electronics', 'slug' => 'electronics'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Home & Living', 'slug' => 'home-living'],
            ['name' => 'Books & Stationery', 'slug' => 'books-stationery'],
            ['name' => 'Sports & Outdoors', 'slug' => 'sports-outdoors'],
            ['name' => 'Health & Beauty', 'slug' => 'health-beauty'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create products
        $products = [
            // Electronics
            [
                'name' => 'Smartphone X Pro',
                'description' => 'Latest flagship smartphone with 6.7" AMOLED display, 108MP camera, and 5G connectivity.',
                'price' => 999.99,
                'stock' => 50,
                'category_id' => 1,
                'image' => 'products/smartphone.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Laptop Ultra',
                'description' => '15" laptop with 11th Gen processor, 16GB RAM, 512GB SSD, and dedicated graphics.',
                'price' => 1299.99,
                'stock' => 30,
                'category_id' => 1,
                'image' => 'products/laptop.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Wireless Earbuds',
                'description' => 'True wireless earbuds with active noise cancellation and 24-hour battery life.',
                'price' => 149.99,
                'stock' => 100,
                'category_id' => 1,
                'image' => 'products/earbuds.jpg',
            ],
            [
                'name' => 'Smart Watch Elite',
                'description' => 'Advanced smartwatch with health tracking, GPS, and 5-day battery life.',
                'price' => 249.99,
                'stock' => 45,
                'category_id' => 1,
                'image' => 'products/smartwatch.jpg',
                'is_featured' => true,
            ],

            // Fashion
            [
                'name' => 'Premium Cotton T-Shirt',
                'description' => 'Soft, breathable 100% organic cotton t-shirt available in multiple colors.',
                'price' => 29.99,
                'stock' => 200,
                'category_id' => 2,
                'image' => 'products/tshirt.jpg',
            ],
            [
                'name' => 'Designer Jeans',
                'description' => 'Classic fit jeans made with premium denim and perfect finishing.',
                'price' => 89.99,
                'stock' => 75,
                'category_id' => 2,
                'image' => 'products/jeans.jpg',
            ],
            [
                'name' => 'Leather Sneakers',
                'description' => 'Handcrafted leather sneakers with comfortable cushioning.',
                'price' => 119.99,
                'stock' => 60,
                'category_id' => 2,
                'image' => 'products/sneakers.jpg',
            ],

            // Home & Living
            [
                'name' => 'Smart Coffee Maker',
                'description' => 'WiFi-enabled coffee maker with scheduling and temperature control.',
                'price' => 199.99,
                'stock' => 40,
                'category_id' => 3,
                'image' => 'products/coffee-maker.jpg',
            ],
            [
                'name' => 'Air Purifier Plus',
                'description' => 'HEPA air purifier with PM2.5 filter and air quality indicator.',
                'price' => 299.99,
                'stock' => 25,
                'category_id' => 3,
                'image' => 'products/air-purifier.jpg',
                'is_featured' => true,
            ],
            [
                'name' => 'Ergonomic Office Chair',
                'description' => 'Adjustable office chair with lumbar support and breathable mesh.',
                'price' => 249.99,
                'stock' => 30,
                'category_id' => 3,
                'image' => 'products/office-chair.jpg',
            ],

            // Books & Stationery
            [
                'name' => 'Productivity Planner',
                'description' => 'Weekly planner with goal setting and habit tracking features.',
                'price' => 24.99,
                'stock' => 150,
                'category_id' => 4,
                'image' => 'products/planner.jpg',
            ],
            [
                'name' => 'Premium Notebook Set',
                'description' => 'Set of 3 hardcover notebooks with premium paper quality.',
                'price' => 34.99,
                'stock' => 100,
                'category_id' => 4,
                'image' => 'products/notebooks.jpg',
            ],

            // Sports & Outdoors
            [
                'name' => 'Smart Yoga Mat',
                'description' => 'Alignment-marking yoga mat with carrying strap.',
                'price' => 79.99,
                'stock' => 50,
                'category_id' => 5,
                'image' => 'products/yoga-mat.jpg',
            ],
            [
                'name' => 'Hiking Backpack',
                'description' => 'Waterproof 40L hiking backpack with multiple compartments.',
                'price' => 129.99,
                'stock' => 40,
                'category_id' => 5,
                'image' => 'products/backpack.jpg',
                'is_featured' => true,
            ],

            // Health & Beauty
            [
                'name' => 'Skincare Set',
                'description' => 'Complete skincare routine with cleanser, toner, and moisturizer.',
                'price' => 89.99,
                'stock' => 60,
                'category_id' => 6,
                'image' => 'products/skincare.jpg',
            ],
            [
                'name' => 'Electric Toothbrush',
                'description' => 'Smart electric toothbrush with pressure sensor and timer.',
                'price' => 149.99,
                'stock' => 45,
                'category_id' => 6,
                'image' => 'products/toothbrush.jpg',
            ],
        ];

        foreach ($products as $product) {
            $product['slug'] = Str::slug($product['name']);
            Product::create($product);
        }
    }
} 