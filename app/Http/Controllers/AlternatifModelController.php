<?php

namespace App\Http\Controllers;

use Bardiz12\AHPDss\AHP;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Bardiz12\AHPDss\Constants;
use App\Models\AlternatifModel;
use App\Http\Controllers\KriteriaController;
use App\Services\AnalyticalHierarchyProcess;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\PembobotanController;

class AlternatifModelController extends Controller
{
    private function pembagi()
    {
        $alternatif = AlternatifModel::all();
        $mapOnlyCriteria = $alternatif->map(function($alternatif) {
            return [
                $alternatif->akreditasi,
                $alternatif->ruang_kelas,
                $alternatif->laboratorium + $alternatif->perpustakaan + $alternatif->uks + $alternatif->sanitasi + $alternatif->tempat_ibadah,
                $alternatif->guru,
                $alternatif->ekstrakulikuler,
                $alternatif->biaya_masuk,
                $alternatif->biaya_spp,
            ];
        });
        
        $sumCriteria = array_fill(0, 7, 0);
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
            $sumCriteria = $this->pembagi();
            return [
                $alternatif->akreditasi/$sumCriteria[0],
                $alternatif->ruang_kelas/$sumCriteria[1],
                ($alternatif->laboratorium + $alternatif->perpustakaan + $alternatif->uks + $alternatif->sanitasi + $alternatif->tempat_ibadah)/$sumCriteria[2],
                $alternatif->guru/$sumCriteria[3],
                $alternatif->ekstrakulikuler/$sumCriteria[4],
                $alternatif->biaya_masuk/$sumCriteria[5],
                $alternatif->biaya_spp/$sumCriteria[6],
            ];
        });
        return $mapOnlyCriteria;
    }

    public function weightedNormalizeMatrix() {
        $weightCriteria = app('App\Http\Controllers\KriteriaController')->calculateGlobalWeight();
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
        $resmax=[];
        $resmin=[];
        $alternatifTerbobot = $this->weightedNormalizeMatrix();
        for ($i=0; $i < count($alternatifTerbobot[0]) ; $i++) { 
            $column = array_column($alternatifTerbobot, $i);
            if ($i >= 5) {
                $maxVal = min($column);
                $minVal = max($column);
            } else {
                $maxVal = max($column);
                $minVal = min($column);
            }

            $resmax[] = $maxVal;
            $resmin[] = $minVal;
        }
        return [$resmax, $resmin];
    }

    public function idealDistance() {
        $alternatifTerbobot = $this->weightedNormalizeMatrix();
        foreach($alternatifTerbobot as $criteria){
            $distancemax = [];
            $distancemin = [];
            list($resmax, $resmin) = $this->idealSolution();
            foreach($criteria as $key => $value) {
                $distancemax[$key] = $value - $resmax[$key];
                $distancemin[$key] = $value - $resmin[$key];
            }
            $tempmax[] = $distancemax;
            $tempmin[] = $distancemin;
        }
        foreach($tempmax as $subArray) {
            $resultArray = [];
            foreach ($subArray as $key => $value) {
                $tempmax[$key] = pow($value,2);
            }
            $resultarr[] = $tempmax;
            $sqrtSumIdealPositive = collect($resultarr)->map(function($items) {
                return sqrt(collect($items)->sum());
            })->toArray();
        }

        foreach($tempmin as $array) {
            foreach ($array as $key => $value) {
                $tempmin[$key] = pow($value,2);
            }
            $resultarray[] = $tempmin;
            $sqrtSumIdealNegative = collect($resultarray)->map(function($items) {
                return sqrt(collect($items)->sum());
            })->toArray(); 
        }
        return [$sqrtSumIdealPositive, $sqrtSumIdealNegative];  
    }

    public function pref() {
        list($sqrtSumIdealPositive, $sqrtSumIdealNegative) = $this->idealDistance();
        
        $negative = collect($sqrtSumIdealNegative);
        $positive = collect($sqrtSumIdealPositive);

        $result = $negative->map(function ($item, $index) use ($positive) {
            return $item/($item + $positive[$index]);
        })->toArray();
        
        dd($result);
    }
}
