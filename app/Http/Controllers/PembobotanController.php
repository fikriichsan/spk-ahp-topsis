<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Bardiz12\AHPDss\Constants;

class PembobotanController extends Controller
{
    public function hitung() {
        // $criteria = ["ipk", "kti", "bing", "prestasi"];
        $oneDimensionalArray = [1, 0.2, 0.25, 0.33, 5, 1, 3, 2, 4, 0.33, 1, 2, 3, 0.5, 0.5, 1];

        // Konversi menjadi matriks
        $columns = 4;
        $multiArray = array();

        for ($i = 0; $i < count($oneDimensionalArray); $i += $columns) {
            $row = array_slice($oneDimensionalArray, $i, $columns);
            $multiArray[] = $row;
        }

        $tot = [];
        $columnSums = array_fill(0, count($multiArray[0]), 0);

        // Iterate through the array and sum the columns
        foreach ($multiArray as $row) {
            foreach ($row as $column => $value) {
                $columnSums[$column] += $value;
            }
        }

        // Print the column sums
        foreach ($columnSums as $sum) {
            $tot[] = $sum;
        }
        $do = $this->normalizeMatrix($multiArray, $tot);
        $da = $this->getEigenVector($do);
        $di = $this->consistencyCheck($multiArray, $da);
        $du = [$multiArray ,$do, $da, $di];
        return $da;
    }

    public function normalizeMatrix (array $matrix,array $tot) {
        $norm=[];
        foreach ($matrix as $key) {
            $inside = [];
            foreach($key as $x => $val) {
                $inside[] = ($val/$tot[$x]);
            }
            $norm[] = $inside;
        }
        return $norm;
    }

    public function getEigenVector (array $matrix) {
        $eigen = [];
        foreach($matrix as $key) {
            $sum = array_sum($key);
            $average = $sum/count($key);
            $eigen[] = $average;
        }
        return $eigen;
    }

    public function consistencyCheck($matrix, $eigen){
        $s = count($matrix);
        $dmax = 0;
        for ($i=0; $i < $s; $i++) { 
            $e = 0;
            for ($j=0; $j < $s; $j++) { 
                $e+= $matrix[$j][$i];
            }
            $dmax+= $e * $eigen[$i];
        }
        $ci = ($dmax - $s)/($s - 1);
        
        $cr = $ci / Constants::getIR($s);
        return $dmax;
    }
}
