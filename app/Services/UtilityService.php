<?php

namespace App\Services;

class UtilityService
{
    public function findDistanceByHaversine($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        //$dist = $dist * 111;
        return $dist;
    }

    public function sortedRoutesByDistance($location, $locations)
    {
        $sorted = $locations->sortBy(function ($item) use ($location) {
            return $this->findDistanceByHaversine($location->latitude, $location->longitude, $item->latitude, $item->longitude);
        });

        return $sorted->values();
    }

    public function createPopulation($locations, $populationSize)
    {
        $population = [];
        for ($i = 0; $i < $populationSize; $i++) {
            $population[] = $this->shuffleLocations($locations);
        }
        return $population;
    }

    public function shuffleLocations($locations)
    {
        $shuffled = $locations;
        shuffle($shuffled);
        return $shuffled;
    }

    public function calculateFitness($population)
    {
        $fitnessScores = [];
        foreach ($population as $individual) {
            $totalDistance = $this->calculateTotalDistance($individual);
            $fitnessScores[] = 1 / ($totalDistance + 1); // Avoid division by zero
        }
        return $fitnessScores;
    }

    public function calculateTotalDistance($locations)
    {
        $totalDistance = 0;
        for ($i = 0; $i < count($locations) - 1; $i++) {
            $totalDistance += $this->findDistanceByHaversine(
                $locations[$i]['latitude'],
                $locations[$i]['longitude'],
                $locations[$i + 1]['latitude'],
                $locations[$i + 1]['longitude']
            );
        }
        return $totalDistance;
    }

    public function selection($population, $fitnessScores)
    {
        $matingPool = [];
        $maxFitness = max($fitnessScores);
        foreach ($population as $index => $individual) {
            $fitness = $fitnessScores[$index] / $maxFitness;
            $n = (int)($fitness * 100);
            for ($j = 0; $j < $n; $j++) {
                $matingPool[] = $individual;
            }
        }
        return $matingPool;
    }

    public function createNextGeneration($matingPool, $mutationRate)
    {
        $newPopulation = [];
        $poolSize = count($matingPool);
        for ($i = 0; $i < $poolSize; $i++) {
            $parentA = $matingPool[array_rand($matingPool)];
            $parentB = $matingPool[array_rand($matingPool)];
            $child = $this->crossover($parentA, $parentB);
            $newPopulation[] = $this->mutate($child, $mutationRate);
        }
        return $newPopulation;
    }

    public function crossover($parentA, $parentB)
    {
        $start = rand(0, count($parentA) - 1);
        $end = rand($start + 1, count($parentA));
        $child = array_slice($parentA, $start, $end - $start);

        foreach ($parentB as $location) {
            if (!in_array($location, $child)) {
                $child[] = $location;
            }
        }
        return $child;
    }

    public function mutate($individual, $mutationRate)
    {
        for ($i = 0; $i < count($individual); $i++) {
            if (rand() / getrandmax() < $mutationRate) {
                $swapIndex = rand(0, count($individual) - 1);
                $temp = $individual[$i];
                $individual[$i] = $individual[$swapIndex];
                $individual[$swapIndex] = $temp;
            }
        }
        return $individual;
    }
}
