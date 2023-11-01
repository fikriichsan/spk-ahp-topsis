<?php

namespace Database\Seeders;

use App\Models\AlternatifModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AlternatifModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlternatifModel::truncate();

        $listAlt = [
            [
                'name' => 'amir',
                'ipk' => 3.68,
                'kti' => 168,
                'bahasa_inggris' => 80,
                'prestasi' => 82,
            ],
            [
                'name' => 'Mira',
                'ipk' => 3.68,
                'kti' => 168,
                'bahasa_inggris' => 81,
                'prestasi' => 81,
            ],
            [
                'name' => 'Riza',
                'ipk' => 3.52,
                'kti' => 161,
                'bahasa_inggris' => 79,
                'prestasi' => 78,
            ],
            [
                'name' => 'Zaki',
                'ipk' => 3.31,
                'kti' => 161,
                'bahasa_inggris' => 84,
                'prestasi' => 84,
            ]
        ];

        foreach ($listAlt as $value) {
            AlternatifModel::create(
                $value
            );
        }
    }
}
