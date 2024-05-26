<?php

namespace App\Classes;

use App\Models\Point;

class KnnClass
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function classify($x, $y, $k, $dataSet = null)
    {
        $points = $dataSet ?? Point::all();
        $distances = [];

        foreach ($points as $point) {
            $distance = sqrt(pow(($point->x - $x), 2) + pow(($point->y - $y), 2));
            $distances[] = [
                'distance' => $distance,
                'class' => $point->class,
            ];
        }

        usort($distances, function ($a, $b) {
            return $a['distance'] <=> $b['distance'];
        });

        $nearest = array_slice($distances, 0, $k);
        $classes = array_column($nearest, 'class');
        $classCounts = array_count_values($classes);

        arsort($classCounts);

        return array_key_first($classCounts);
    }

    public function crossValidate($kValues, $numFolds = 5, $dataSet = null)
    {
        $points = $dataSet ?? Point::all();
        $foldSize = ceil(count($points) / $numFolds);
        $accuracy = [];

        foreach ($kValues as $k) {
            $totalAccuracy = 0;

            for ($i = 0; $i < $numFolds; $i++) {
                $validationSet = $points->slice($i * $foldSize, $foldSize);
                $trainingSet = $points->except(range($i * $foldSize, min(($i + 1) * $foldSize, count($points)) - 1));

                $correct = 0;

                foreach ($validationSet as $valPoint) {
                    $prediction = $this->classify($valPoint->x, $valPoint->y, $k, $trainingSet);
                    if ($prediction == $valPoint->class) {
                        $correct++;
                    }
                }

                $totalAccuracy += $correct / count($validationSet);
            }

            $accuracy[$k] = $totalAccuracy / $numFolds;
        }

        arsort($accuracy);
        return $accuracy;
    }
}
