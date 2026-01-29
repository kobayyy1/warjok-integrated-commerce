<?php

namespace Database\Seeders;

use App\Models\Warung;
use Illuminate\Database\Seeder;

class WarungSeeder extends Seeder
{
    public function run(): void
    {
        $warungs = [
            [
                'name' => 'Warung Pojok Cabang 1',
                'description' => 'Warung Pojok cabang pertama di Jakarta Utara',
            ],
            [
                'name' => 'Warung Pojok Cabang 2',
                'description' => 'Warung Pojok cabang kedua di Jakarta Selatan',
            ],
            [
                'name' => 'Warung Pojok Cabang 3',
                'description' => 'Warung Pojok cabang ketiga di Jakarta Timur',
            ],
        ];

        foreach ($warungs as $warung) {
            Warung::create($warung);
        }
    }
}