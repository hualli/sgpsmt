<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuario específico
        User::create([
            'name' => 'Roberto Torfe',
            'email' => 'robertotorfe@gmail.com',
            'password' => Hash::make('password'),
        ]);

        // 5 usuarios genéricos
        User::factory(5)->create();
    }
}
