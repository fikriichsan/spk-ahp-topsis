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
            $table->float('npsn');
            $table->float('akreditasi');
            $table->float('ruang_kelas');
            $table->float('laboratorium');
            $table->float('perpustakaan');
            $table->float('uks');
            $table->float('sanitasi');
            $table->float('tempat_ibadah');
            $table->float('guru');
            $table->float('ekstrakulikuler'); 
            $table->float('biaya_masuk'); 
            $table->float('biaya_spp'); 
            $table->float('longitude'); 
            $table->float('latitude'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatif_models');
    }
};
