<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use App\Models\KriteriaModel;
use App\Models\User;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index(Request $request) {
        $locationSchool = AlternatifModel::select('nama_sekolah', 'longitude', 'latitude')->get();
        return view('dashboard', [
            'title' => 'DASHBOARD',
            'total_user' => User::all()->count(),
            'total_alternatif' => AlternatifModel::all()->count(),
            'total_kriteria' => KriteriaModel::all()->count(),
            'lokasi_sekolah' => compact('locationSchool')
        ]);


    }
}
