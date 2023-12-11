<?php

namespace Database\Seeders;

use App\Models\SubKriteriaBiayaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKriteriaBiayaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubKriteriaBiayaModel::truncate();

        $listAlt = [
            [
                'nama_kriteria' => 'Biaya masuk',
                'biaya_masuk' => 1,
                'biaya_spp' => 0.601,
            ],
            [
                'nama_kriteria' => 'Biaya SPP',
                'biaya_masuk' => 1.664,
                'biaya_spp' => 1,
            ],
        ];

        foreach ($listAlt as $value) {
            SubKriteriaBiayaModel::create(
                $value
            );
        }
    }
}
