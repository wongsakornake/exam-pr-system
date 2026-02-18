<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'tel' => '0812345678',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        // Users
        User::factory()->create([
            'name' => 'User One',
            'email' => 'user1@example.com',
            'tel' => '0823456789',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'User Two',
            'email' => 'user2@example.com',
            'tel' => '0834567890',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'User Three',
            'email' => 'user3@example.com',
            'tel' => '0845678901',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'User Four',
            'email' => 'user4@example.com',
            'tel' => '0856789012',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);
    }
}