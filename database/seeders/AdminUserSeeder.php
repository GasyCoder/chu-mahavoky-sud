<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Delete existing users to avoid duplicates (optional)
        User::where('id', '>', 0)->delete();

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@chu.mg',
            'role' => 'admin',
            'password' => Hash::make('admin@chu.mg'), // Change this to a secure password
            'email_verified_at' => now(),
        ]);
    }
}
