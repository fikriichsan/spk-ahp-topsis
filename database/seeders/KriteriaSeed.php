<?php

namespace Database\Seeders;

use App\Models\KriteriaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        KriteriaModel::truncate();

        $listAlt = [
            [
                'name_kriteria' => 'akreditasi',
                'akreditasi' => 1,
                'fasilitas' => 3,
                'biaya' => 7,
            ],
            [
                'name_kriteria' => 'fasilitas',
                'akreditasi' => 0.33,
                'fasilitas' => 1,
                'biaya' => 5,
            ],
            [
                'name_kriteria' => 'biaya',
                'akreditasi' => 0.15,
                'fasilitas' => 0.2,
                'biaya' => 1,
            ],
        ];

        foreach ($listAlt as $value) {
            KriteriaModel::create(
                $value
            );
        }
    }
}
