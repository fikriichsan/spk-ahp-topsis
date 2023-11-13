<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_kriteria',
        'akreditasi',
        'fasilitas',
        'biaya',
        'lokasi'
    ];
}
