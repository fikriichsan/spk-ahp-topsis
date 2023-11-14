<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use App\Services\AnalyticalHierarchyProcess;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    protected $ahp;
    public  function __construct(AnalyticalHierarchyProcess $ahp)
    {
        $this->ahp = $ahp;
    }

    public function index() {
        $kriteria = KriteriaModel::all();
        return view('kriteria', [
            'title' => 'Kriteria',
            'kriteria' => $kriteria
        ]);
    }

    public function show() {
        $kriteria = KriteriaModel::select('akreditasi', 'fasilitas', 'biaya', 'lokasi')->get();
        $newKriteria = $kriteria->map(function ($kriteria) {
            return [
                $kriteria->akreditasi,
                $kriteria->fasilitas,
                $kriteria->biaya,
                $kriteria->lokasi,
            ];
        })->toArray();
        $total = $this->ahp->hitungTotal($newKriteria);
        $normalizeMatrix = $this->ahp->normalizeMatrix($newKriteria, $total);
        $eigenVector = $this->ahp->getEigenVector($normalizeMatrix);
        $consistencyCheck =$this->ahp->concistencyCheck($newKriteria, $eigenVector);
        dd($consistencyCheck);
        
    }
}
