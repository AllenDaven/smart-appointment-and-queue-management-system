<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed roles first
        $this->call(RoleSeeder::class);

        // Optional: create test user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1, // assign admin role
        ]);

        // Create Staff user
        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => Hash::make('staff123'),
            'role_id' => 2,
        ]);
    }
}