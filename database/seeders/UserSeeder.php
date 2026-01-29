<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin (bisa akses semua warung)
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@warungpojok.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'store_id' => null,
        ]);

        // Admin Warung 1
        User::create([
            'name' => 'Admin Warung 1',
            'email' => 'admin1@warungpojok.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'store_id' => 1,
        ]);

        // Admin Warung 2
        User::create([
            'name' => 'Admin Warung 2',
            'email' => 'admin2@warungpojok.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'store_id' => 2,
        ]);

        // Admin Warung 3
        User::create([
            'name' => 'Admin Warung 3',
            'email' => 'admin3@warungpojok.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'store_id' => 3,
        ]);
    }
}