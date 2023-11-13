<?php
namespace App\Services;

class AnalyticalHierarchyProcess {

    public function hitungTotal (array $multiArray) {

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

        return $tot;
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

    public static $ir = [
        0.00,
        0.00,
        0.58,
        0.90,
        1.12,
        1.24,
        1.32,
        1.41,
        1.45,
        1.49,
        1.51,
        1.48,
        1.56,
        1.57,
        1.59
    ];

    public static function getIR($matrix_size){
        return isset(self::$ir[$matrix_size-1]) ? self::$ir[$matrix_size-1] : null;
    }

    public function concistencyCheck($matrix,$eigen){
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
        
        $cr = $ci / $this->getIR($s);
        return $cr;
    }


};