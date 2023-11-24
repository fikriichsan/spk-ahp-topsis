<?php

namespace App\Http\Controllers;

use App\Models\KriteriaModel;
use App\Models\SubKriteriaBiayaModel;
use App\Models\SubKriteriaFasilitasModel;
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
        $kriteria = $this->calculateKriteria();
        $sub_kriteria_fasilitas = $this->calculateSubFasilitas();
        $sub_kriteria_biaya = $this->calculateSubBiaya();
        $globalWeight = $this->calculateGlobalWeight();
        return view('kriteria', [
            'title' => 'Kriteria',
            'kriteria' => $kriteria[0],
            "eigen_vector" => $kriteria[1],
            "consistency" => $kriteria[2],
            "subKriteria_fasilitas" => $sub_kriteria_fasilitas[0],
            "eigen_vector_fasilitas" => $sub_kriteria_fasilitas[1],
            "consistency_fasilitas" => $sub_kriteria_fasilitas[2],
            "subKriteria_biaya" => $sub_kriteria_biaya[0],
            "eigen_vector_biaya" => $sub_kriteria_biaya[1],
            "consistency_biaya" => $sub_kriteria_biaya[2],
        ]);
    }

    private function calculateKriteria() {
        $kriteria = KriteriaModel::all();
        $newKriteria = $kriteria->map(function ($kriteria) {
            return [
                $kriteria->akreditasi,
                $kriteria->fasilitas,
                $kriteria->biaya,
            ];
        })->toArray();
        $total = $this->ahp->hitungTotal($newKriteria);
        $normalizeMatrix = $this->ahp->normalizeMatrix($newKriteria, $total);
        $eigenVector = $this->ahp->getEigenVector($normalizeMatrix);
        $consistencyCheck =$this->ahp->concistencyCheck($newKriteria, $eigenVector);
        $hasil = [$kriteria, $eigenVector, $consistencyCheck];
        return ($hasil);
    }

    private function calculateSubFasilitas() {
        $subKriteriaFasilitas = SubKriteriaFasilitasModel::all();
        $newKriteriaFasilitas = $subKriteriaFasilitas->map(function ($subKriteria) {
            return [
                $subKriteria->ruang_kelas,
                $subKriteria->sarana_pendukung,
                $subKriteria->guru,
                $subKriteria->ekstrakulikuler,
            ];
        })->toArray();
        $total = $this->ahp->hitungTotal($newKriteriaFasilitas);
        $normalizeMatrix = $this->ahp->normalizeMatrix($newKriteriaFasilitas, $total);
        $eigenVector = $this->ahp->getEigenVector($normalizeMatrix);
        $consistencyCheck =$this->ahp->concistencyCheck($newKriteriaFasilitas, $eigenVector);
        $hasil = [$subKriteriaFasilitas,$eigenVector, $consistencyCheck];
        return ($hasil);
    }
    private function calculateSubBiaya() {
        $subKriteriaBiaya = SubKriteriaBiayaModel::all();
        $newKriteriaBiaya = $subKriteriaBiaya->map(function ($subKriteria) {
            return [
                $subKriteria->biaya_masuk,
                $subKriteria->biaya_spp,
            ];
        })->toArray();
        $total = $this->ahp->hitungTotal($newKriteriaBiaya);
        $normalizeMatrix = $this->ahp->normalizeMatrix($newKriteriaBiaya, $total);
        $eigenVector = $this->ahp->getEigenVector($normalizeMatrix);
        $consistencyCheck =$this->ahp->concistencyCheck($newKriteriaBiaya, $eigenVector);
        $hasil = [$subKriteriaBiaya,$eigenVector, $consistencyCheck];
        return ($hasil);
    }

    public function calculateGlobalWeight() {
        $kriteria = $this->calculateKriteria()[1];
        $sub_kriteria_fasilitas = $this->calculateSubFasilitas()[1];
        $sub_kriteria_biaya = $this->calculateSubBiaya()[1];
        $globalWeight = [
            $kriteria[0],
            $kriteria[1]*$sub_kriteria_fasilitas[0],
            $kriteria[1]*$sub_kriteria_fasilitas[1],
            $kriteria[1]*$sub_kriteria_fasilitas[2],
            $kriteria[1]*$sub_kriteria_fasilitas[3],
            $kriteria[2]*$sub_kriteria_biaya[0],
            $kriteria[2]*$sub_kriteria_biaya[1],
        ];
        return ($globalWeight);
    }
}
