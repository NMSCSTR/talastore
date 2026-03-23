<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplier = \App\Models\Supplier::first();
        $category = \App\Models\Category::first();

        \App\Models\Product::create([
            'supplier_id' => $supplier->id,
            'category_id' => $category->id,
            'name'        => 'Sample Smartphone',
            'description' => 'A high-end smartphone with a great camera.',
            'price'       => 25000.00,
            'stock'       => 10,
        ]);
    }
}
