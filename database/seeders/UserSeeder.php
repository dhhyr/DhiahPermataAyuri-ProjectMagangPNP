<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah user dengan email ini sudah ada, kalau belum, buat baru
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // cari berdasarkan email
            [
                'name' => 'admin',
                'password' => Hash::make('password'), // password default
            ]
        );
    }
}
