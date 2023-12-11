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
                'fasilitas' => 2.267,
                'biaya' => 1.253,
                'lokasi' => 1.818,
            ],
            [
                'name_kriteria' => 'fasilitas',
                'akreditasi' => 0.441,
                'fasilitas' => 1,
                'biaya' => 1.456,
                'lokasi' => 2.329,
            ],
            [
                'name_kriteria' => 'biaya',
                'akreditasi' => 0.798,
                'fasilitas' => 0.687,
                'biaya' => 1,
                'lokasi' => 1.253,
            ],
            [
                'name_kriteria' => 'lokasi',
                'akreditasi' => 0.550,
                'fasilitas' => 0.429,
                'biaya' => 0.798,
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
