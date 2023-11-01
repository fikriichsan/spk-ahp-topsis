<?php

namespace App\Http\Controllers;

use App\Models\AlternatifModel;
use Bardiz12\AHPDss\AHP;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Bardiz12\AHPDss\Constants;
use App\Services\AnalyticalHierarchyProcess;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\PembobotanController;

class AlternatifModelController extends Controller
{
    public function akar()
    {
        $alternatif = AlternatifModel::all();
        $mapOnlyCriteria = $alternatif->map(function($alternatif) {
            return [
                $alternatif->ipk,
                $alternatif->kti,
                $alternatif->bahasa_inggris,
                $alternatif->prestasi,
            ];
        });
        $sumCriteria = array_fill(0, 4, 0);
        foreach ($mapOnlyCriteria as $criteria ) {
            foreach ($criteria as $key => $value) {
                $sumCriteria[$key] += pow($value, 2);
            }
        }
        foreach ($sumCriteria as $key =>$value) {
           $sumCriteria[$key] = sqrt($value);
        }

        return $sumCriteria;
    }

    public function normalizeMatrix(){
        $alternatif = AlternatifModel::all();
        $mapOnlyCriteria = $alternatif->map(function($alternatif) {
            $sumCriteria = $this->akar();
            return [
                $alternatif->ipk/$sumCriteria[0],
                $alternatif->kti/$sumCriteria[1],
                $alternatif->bahasa_inggris/$sumCriteria[2],
                $alternatif->prestasi/$sumCriteria[3],
            ];
        });

        return $mapOnlyCriteria;
    }

    public function weightedNormalizeMatrix() {
        $weightCriteria = new PembobotanController();
        $weightCriteria = $weightCriteria->hitung();
        $mapOnlyCriteria = $this->normalizeMatrix();
        $weightedMatrix = [];
        for ($i=0; $i < count($mapOnlyCriteria); $i++) { 
            $row = $mapOnlyCriteria[$i];
            $rowResult = [];
            for ($j=0; $j < count($row); $j++) { 
                $result = $row[$j]*$weightCriteria[$j];
                $rowResult[] = $result;
            }
            $weightedMatrix[] = $rowResult;
        }
        return $weightedMatrix;
    }

    public function idealSolution() {
        $alternatifTerbobot = $this->weightedNormalizeMatrix();
        for ($i=0; $i < count($alternatifTerbobot); $i++) { 
            $row = $alternatifTerbobot[$i];
            for ($j=0; $j < count($row); $j++) {
                 
            }
        }
        

    }
}
