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
            $table->string('name');
            $table->float('ipk');
            $table->integer('kti');
            $table->integer('prestasi');
            $table->integer('bahasa_inggris');
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
