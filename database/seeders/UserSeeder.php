<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Pastikan menggunakan Hash untuk keamanan
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('userpass456'),
        ]);

        User::create([
            'name' => 'zefri',
            'email' => 'zefrifahlevi@yahoo.co.uk',
            'password' => Hash::make('zefrifahlevi'),
        ]);
    }
}
