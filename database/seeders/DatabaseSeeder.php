<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // PENTING: Warung harus di-seed dulu sebelum User
        // karena User memiliki foreign key ke Warung
        $this->call([
            StoreSeeder::class,  // Seed warung terlebih dahulu
            UserSeeder::class,    // Baru seed user
        ]);
    }
}