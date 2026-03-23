<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Electronics', 'Fashion', 'Home Decor', 'Health'];
        foreach ($categories as $cat) {
            \App\Models\Category::create([
                'name' => $cat,
                'slug' => str()->slug($cat),
            ]);
        }
    }
}
