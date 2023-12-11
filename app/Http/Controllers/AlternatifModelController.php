<?php

namespace App\Http\Controllers;

use Bardiz12\AHPDss\AHP;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Bardiz12\AHPDss\Constants;
use App\Models\AlternatifModel;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\KriteriaController;
use App\Services\AnalyticalHierarchyProcess;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\PembobotanController;

class AlternatifModelController extends Controller
{
    public function index() {
        $locationSchool = AlternatifModel::select('nama_sekolah', 'longitude', 'latitude')->get();
        $alternatif = AlternatifModel::all();
        $mapOnlyCriteria = $alternatif->map(function($alternatif) {
            return [
                $alternatif->id,
                $alternatif->nama_sekolah,
                $alternatif->akreditasi,
                $alternatif->ruang_kelas,
                $alternatif->laboratorium + $alternatif->perpustakaan + $alternatif->uks + $alternatif->sanitasi + $alternatif->tempat_ibadah,
                $alternatif->guru,
                $alternatif->ekstrakulikuler,
                $alternatif->biaya_masuk,
                $alternatif->biaya_spp,
            ];
        });
        
        return view('spk', [
            'title' => 'REKOMENDASI',
            'alternatif' => AlternatifModel::all(),
            'lokasi_sekolah' => compact('locationSchool')
        ]);
    }

    public function hitungTopsis(Request $request){
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $jarakSekolah = [];
        $ranking = 1;
        $school = AlternatifModel::all()->toArray();
        foreach ($school as $key ) {
            $long1 = deg2rad($longitude);
            $long2 = deg2rad($key['longitude']);
            $lat1 = deg2rad($latitude);
            $lat2 = deg2rad($key['latitude']);
            $dlong = $long2 - $long1;
		    $dlati = $lat2 - $lat1;
		    $val = pow(sin($dlati/2),2)+cos($lat1)*cos($lat2)*pow(sin($dlong/2),2);
            $res = 2 * asin(sqrt($val));
            $radius = 6371;
            $distance = $res*$radius;
            $jarakSekolah[] = $distance;
        }
        for ($i=0; $i < count($school) ; $i++) {
            if ($longitude==0) {
                $school[$i] += ['jarak'=>0]; 
            } else {
                $school[$i] += ['jarak'=>$jarakSekolah[$i]];  
            }
        }

        $pembagi = $this->pembagi($school);
        $normalizeMatrix = $this->normalizeMatrix($school, $pembagi[1]);
        $weightedMatrix = $this->weightedNormalizeMatrix($normalizeMatrix);
        $idealSolution = $this->idealSolution($weightedMatrix);
        $idealDistance = $this->idealDistance($weightedMatrix, $idealSolution);
        $nilaiPref = $this->pref($idealDistance);

        for ($i=0; $i <count($school) ; $i++) { 
            $school[$i] += ['score'=>$nilaiPref[$i]];
        }
        array_multisort($nilaiPref, SORT_DESC, $school);
        for ($i=0; $i <count($school) ; $i++) { 
            $school[$i] += ['rank'=>$ranking];
            $ranking++;
        }

        return view('rekomendasi', [
            'title'=> 'REKOMENDASI',
            'hasil' => $school
        ]);
    }

    private function pembagi(array $alternatif)
    {
        $alternatifOnlyCriteria = [];
        foreach ($alternatif as $key ) {
            $criteria = [];
            $criteria[] = $key['akreditasi'];
            $criteria[] = $key['ruang_kelas'];
            $criteria[] = $key['laboratorium']+$key['perpustakaan']+$key['uks']+$key['sanitasi']+$key['tempat_ibadah'];
            $criteria[] = $key['guru'];
            $criteria[] = $key['ekstrakulikuler'];
            $criteria[] = $key['biaya_masuk'];
            $criteria[] = $key['biaya_spp'];
            $criteria[] = $key['jarak'];
            $alternatifOnlyCriteria[] = $criteria;
        }
        
        $sumCriteria = array_fill(0, 8, 0);
        foreach ($alternatifOnlyCriteria as $criteria ) {
            foreach ($criteria as $key => $value) {
                $sumCriteria[$key] += pow($value, 2);
            }
        }
        foreach ($sumCriteria as $key =>$value) {
           $sumCriteria[$key] = sqrt($value);
        }


        return [$alternatifOnlyCriteria, $sumCriteria];
    }

    public function normalizeMatrix(array $alternatif, array $pembagi){
        $alternatifOnlyCriteria = [];
        foreach ($alternatif as $key ) {
            $sumCriteria = $pembagi;
            $criteria = [];
            $criteria[] = $key['akreditasi']/$sumCriteria[0];
            $criteria[] = $key['ruang_kelas']/$sumCriteria[1];
            $criteria[] = ($key['laboratorium']+$key['perpustakaan']+$key['uks']+$key['sanitasi']+$key['tempat_ibadah'])/$sumCriteria[2];
            $criteria[] = $key['guru']/$sumCriteria[3];
            $criteria[] = $key['ekstrakulikuler']/$sumCriteria[4];
            $criteria[] = $key['biaya_masuk']/$sumCriteria[5];
            $criteria[] = $key['biaya_spp']/$sumCriteria[6];
            $criteria[] = $key['jarak']/$sumCriteria[7];
            $alternatifOnlyCriteria[] = $criteria;
        }
        return $alternatifOnlyCriteria;
    }

    public function weightedNormalizeMatrix(array $normalizeMatrix) {
        $weightCriteria = app('App\Http\Controllers\KriteriaController')->calculateGlobalWeight();
        $mapOnlyCriteria = $normalizeMatrix;
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

    public function idealSolution(array $weightedMatrix) {
        $resmax=[];
        $resmin=[];
        $alternatifTerbobot = $weightedMatrix;
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

    public function idealDistance(array $weightedMatrix, array $idealSolution) {
        $alternatifTerbobot = $weightedMatrix;
        foreach($alternatifTerbobot as $criteria){
            $distancemax = [];
            $distancemin = [];
            list($resmax, $resmin) = $idealSolution;
            foreach($criteria as $key => $value) {
                $distancemax[$key] = pow($value - $resmax[$key],2);
                $distancemin[$key] = pow($value - $resmin[$key],2);
            }
            $tempmax[] = $distancemax;
            $tempmin[] = $distancemin;
        }

        $resultArrayIdealPos = [];
        foreach($tempmax as $subArray) {
            $resultArrayIdealPos[] = sqrt(array_sum($subArray));   
        }
        
        $resultArrayIdealNeg = [];
        foreach($tempmin as $subArr) {
            $resultArrayIdealNeg[] = sqrt(array_sum($subArr)); 
        }

        return [$resultArrayIdealPos, $resultArrayIdealNeg];  
    }

    public function pref(array $idealDistance) {
        list($sqrtSumIdealPositive, $sqrtSumIdealNegative) = $idealDistance;
        
        $negative = collect($sqrtSumIdealNegative);
        $positive = collect($sqrtSumIdealPositive);

        $result = $negative->map(function ($item, $index) use ($positive) {
            return $item/($item + $positive[$index]);
        })->toArray();
        
        return $result;
    }   
}
