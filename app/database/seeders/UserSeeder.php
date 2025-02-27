<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => 'secret',
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => 'secret',
            'is_admin' => false
        ]);
    }
}
