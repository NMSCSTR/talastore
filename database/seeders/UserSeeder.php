<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an Admin
        \App\Models\User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@tala.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // Create a Supplier
        $user = \App\Models\User::create([
            'name'     => 'Juan Supplier',
            'email'    => 'supplier@tala.com',
            'password' => bcrypt('password'),
            'role'     => 'supplier',
        ]);

        $user->supplier()->create([
            'store_name'        => 'Tala Central Store',
            'store_description' => 'Best items in Bacolod',
        ]);
    }
}
