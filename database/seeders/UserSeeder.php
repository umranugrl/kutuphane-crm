<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin Kullanıcısı
        User::create([
            'name' => 'Admin Kullanıcı',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), 
        ]);

        // Normal Kullanıcı
        // User::create([
        //     'name' => 'Normal Kullanıcı',
        //     'email' => 'user@example.com',
        //     'password' => Hash::make('user123'),
        // ]);
    }
}
