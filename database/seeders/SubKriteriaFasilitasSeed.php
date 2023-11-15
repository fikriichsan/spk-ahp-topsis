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
                'sarana_pendukung' => 0,
                'guru' => 0,
                'ekstrakulikuler' => 0,
            ],
            [
                'nama_kriteria' => 'Sarana Pendukung',
                'ruang_kelas' => 0,
                'sarana_pendukung' => 1,
                'guru' => 0,
                'ekstrakulikuler' => 0,
            ],
            [
                'nama_kriteria' => 'Guru',
                'ruang_kelas' => 0,
                'sarana_pendukung' => 0,
                'guru' => 1,
                'ekstrakulikuler' => 0,
            ],
            [
                'nama_kriteria' => 'Ekstrakulikuler',
                'ruang_kelas' => 0,
                'sarana_pendukung' => 0,
                'guru' => 0,
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
