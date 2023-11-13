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
                'biaya' => 2,
                'lokasi' => 4,
            ],
            [
                'name_kriteria' => 'fasilitas',
                'akreditasi' => 0.33,
                'fasilitas' => 1,
                'biaya' => 0.50,
                'lokasi' => 5,
            ],
            [
                'name_kriteria' => 'biaya',
                'akreditasi' => 0.5,
                'fasilitas' => 2,
                'biaya' => 1,
                'lokasi' => 3,
            ],
            [
                'name_kriteria' => 'lokasi',
                'akreditasi' => 0.25,
                'fasilitas' => 0.20,
                'biaya' => 0.33,
                'lokasi' => 1,
            ],
        ];

        foreach ($listAlt as $value) {
            KriteriaModel::create(
                $value
            );
        }
    }
}
