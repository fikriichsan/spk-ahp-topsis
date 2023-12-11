<?php

namespace Database\Seeders;

use App\Models\SubKriteriaFasilitasModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKriteriaFasilitasSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubKriteriaFasilitasModel::truncate();

        $listAlt = [
            [
                'nama_kriteria' => 'Ruang Kelas',
                'ruang_kelas' => 1,
                'sarana_pendukung' => 1.396,
                'guru' => 0.394,
                'ekstrakulikuler' => 2.192,
            ],
            [
                'nama_kriteria' => 'Sarana Pendukung',
                'ruang_kelas' => 0.716,
                'sarana_pendukung' => 1,
                'guru' => 0.358,
                'ekstrakulikuler' => 2.135,
            ],
            [
                'nama_kriteria' => 'Guru',
                'ruang_kelas' => 2.541,
                'sarana_pendukung' => 2.793,
                'guru' => 1,
                'ekstrakulikuler' => 3.935,
            ],
            [
                'nama_kriteria' => 'Ekstrakulikuler',
                'ruang_kelas' => 0.456,
                'sarana_pendukung' => 0.468,
                'guru' => 0.254,
                'ekstrakulikuler' => 1,
            ]
        ];

        foreach ($listAlt as $value) {
            SubKriteriaFasilitasModel::create(
                $value
            );
        }
    }
}
