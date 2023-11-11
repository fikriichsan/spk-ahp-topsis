<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AlternatifModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_sekolah', 
        'user_id',
        'alamat',
        'contact',
        'instagram',
        'website_sekolah',
        'npsn', 
        'akreditasi', 
        'ruang_kelas', 
        'laboratorium', 
        'perpustakaan', 
        'uks', 
        'sanitasi', 
        'tempat_ibadah', 
        'guru', 
        'ekstrakulikuler', 
        'biaya_masuk', 
        'biaya_spp', 
        'longitude', 
        'latitude',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
