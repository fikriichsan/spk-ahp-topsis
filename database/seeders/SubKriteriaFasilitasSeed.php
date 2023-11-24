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
                'sarana_pendukung' => 1,
                'guru' => 0.3333333333,
                'ekstrakulikuler' => 3,
            ],
            [
                'nama_kriteria' => 'Sarana Pendukung',
                'ruang_kelas' => 1,
                'sarana_pendukung' => 1,
                'guru' => 1,
                'ekstrakulikuler' => 3,
            ],
            [
                'nama_kriteria' => 'Guru',
                'ruang_kelas' => 3,
                'sarana_pendukung' => 1,
                'guru' => 1,
                'ekstrakulikuler' => 5,
            ],
            [
                'nama_kriteria' => 'Ekstrakulikuler',
                'ruang_kelas' => 0.3333333333,
                'sarana_pendukung' => 0.3333333333,
                'guru' => 0.2,
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
