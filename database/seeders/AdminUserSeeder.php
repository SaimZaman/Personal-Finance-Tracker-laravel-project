<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'usertype' => 'admin',
                'status' => 'active',
            ]);
        }

        // Create a few test users
        if (User::count() < 5) {
            User::factory()->create([
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'usertype' => 'user',
                'status' => 'active',
            ]);

            User::factory()->create([
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'usertype' => 'user',
                'status' => 'active',
            ]);

            User::factory()->create([
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'usertype' => 'user',
                'status' => 'inactive',
            ]);
        }
    }
}