<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\KriteriaSeed;
use Database\Seeders\SubKriteriaBiayaSeed;
use Database\Seeders\SubKriteriaFasilitasSeed;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            KriteriaSeed::class,
            SubKriteriaBiayaSeed::class,
            SubKriteriaFasilitasSeed::class
        ]);
    }
}
