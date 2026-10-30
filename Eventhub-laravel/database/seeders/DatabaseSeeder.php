<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // <-- Tambahkan baris ini

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
       User::factory()->create([
        'username' => 'admin',
         'password' => Hash::make('admin123'),
         'role' => 'admin',
]);
    }
}