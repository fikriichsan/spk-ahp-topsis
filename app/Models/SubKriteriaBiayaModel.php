<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteriaBiayaModel extends Model
{
    use HasFactory;

    protected $fillable = [
        "nama_kriteria",
        "biaya_masuk",
        "biaya_spp",
    ];
}
