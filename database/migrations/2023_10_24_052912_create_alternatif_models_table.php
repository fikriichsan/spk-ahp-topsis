<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('alternatif_models', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->integer('user_id');
            $table->string('alamat');
            $table->string('contact');
            $table->string('instagram');
            $table->string('website_sekolah');
            $table->string('npsn');
            $table->float('akreditasi');
            $table->float('ruang_kelas');
            $table->float('laboratorium');
            $table->float('perpustakaan');
            $table->float('uks');
            $table->float('sanitasi');
            $table->float('tempat_ibadah');
            $table->float('guru');
            $table->float('ekstrakulikuler'); 
            $table->string('biaya_masuk'); 
            $table->string('biaya_spp'); 
            $table->string('longitude'); 
            $table->string('latitude'); 
            $table->timestamps();
        });
        Schema::create('kriteria_models', function (Blueprint $table) {
            $table->id();
            $table->string('name_kriteria');
            $table->float('akreditasi');
            $table->float('fasilitas');
            $table->float('biaya');
            $table->float('lokasi');
            $table->timestamps();
        });
        Schema::create('sub_kriteria_fasilitas_models', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria');
            $table->float('ruang_kelas');
            $table->float('sarana_pendukung');
            $table->float('guru');
            $table->float('ekstrakulikuler');
            $table->timestamps();
        });
        Schema::create('sub_kriteria_biaya_models', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kriteria');
            $table->float('biaya_masuk');
            $table->float('biaya_spp');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif_models');
        Schema::dropIfExists('kriteria_models');
        Schema::dropIfExists('subKriteria_fasilitas_models');
        Schema::dropIfExists('subKriteria_biaya_models');
    }
};
