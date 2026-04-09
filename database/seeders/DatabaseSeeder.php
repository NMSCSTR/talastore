<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // --- 1. CREATE USERS (Admin, Supplier, and Customer) ---
        $admin = User::create([
            'name' => 'Rhondel Admin',
            'email' => 'admin@talastore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $supplierUser = User::create([
            'name' => 'Juan Dela Cruz',
            'email' => 'supplier@talastore.com',
            'password' => Hash::make('password'),
            'role' => 'supplier',
            'phone' => '09123456789',
            'address' => 'Tangub City, Misamis Occidental',
        ]);

        $customer = User::create([
            'name' => 'Jane Doe',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        // --- 2. CREATE CATEGORIES ---
        $categories = [
            ['name' => 'Local Crafts', 'slug' => 'local-crafts'],
            ['name' => 'Essentials', 'slug' => 'essentials'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Home Decor', 'slug' => 'home-decor'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // --- 3. CREATE SUPPLIER PROFILE ---
        $supplier = Supplier::create([
            'user_id' => $supplierUser->id,
            'store_name' => 'Tangub Heritage Crafts',
            'store_description' => 'Authentic local products made with love from Northern Mindanao.',
        ]);

        // --- 4. CREATE SAMPLE PRODUCTS ---
        $craftCat = Category::where('slug', 'local-crafts')->first();
        $decorCat = Category::where('slug', 'home-decor')->first();

        Product::create([
            'supplier_id' => $supplier->id,
            'category_id' => $craftCat->id,
            'name' => 'Handwoven Abaca Basket',
            'description' => 'Eco-friendly and durable basket made from organic abaca fibers.',
            'price' => 450.00,
            'stock' => 15,
            'image' => null, // Placeholder will trigger in blade
        ]);

        Product::create([
            'supplier_id' => $supplier->id,
            'category_id' => $decorCat->id,
            'name' => 'Bamboo Bedside Lamp',
            'description' => 'Modern minimalist lamp made from sustainable bamboo.',
            'price' => 1200.00,
            'stock' => 5,
            'image' => null,
        ]);

        Product::create([
            'supplier_id' => $supplier->id,
            'category_id' => $craftCat->id,
            'name' => 'Native Salakot Hat',
            'description' => 'Traditional Filipino headgear, perfect for outdoor decor or use.',
            'price' => 350.00,
            'stock' => 25,
            'image' => null,
        ]);

        Product::create([
            'supplier_id' => $supplier->id,
            'category_id' => $decorCat->id,
            'name' => 'Hand-painted Ceramic Vase',
            'description' => 'Unique floral patterns, kiln-fired for a glossy finish.',
            'price' => 850.00,
            'stock' => 8,
            'image' => null,
        ]);
    }
}
