<?php

namespace Database\Seeders;

use App\Models\Store;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        $stores = [
            [
                'name' => 'Warung Pojok Cabang Utara',
                'slug' => 'warung-pojok-utara',
                'address' => 'Jl. Utara Raya No. 123',
                'phone' => '081234567890',
                'is_active' => true,
            ],
            [
                'name' => 'Warung Pojok Cabang Selatan',
                'slug' => 'warung-pojok-selatan',
                'address' => 'Jl. Selatan Raya No. 456',
                'phone' => '081234567891',
                'is_active' => true,
            ],
            [
                'name' => 'Warung Pojok Cabang Timur',
                'slug' => 'warung-pojok-timur',
                'address' => 'Jl. Timur Raya No. 789',
                'phone' => '081234567892',
                'is_active' => true,
            ],
        ];

        foreach ($stores as $store) {
            Store::create($store);
        }
    }
}
