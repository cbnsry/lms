<?php

namespace App\Services;

use App\Services\UtilityService;

class RouteService
{
    protected $utility_service;

    public function __construct(UtilityService $utility_service)
    {
        $this->utility_service = $utility_service;
    }

    public function sortedLocationsByKNN($location, $locations)
    {
        $currentLocation = $location;
        $sortedLocations = [];
        $remainingLocations = $locations->toArray();

        // Helper function to calculate the total distance of a path
        $calculateTotalDistance = function ($path) {
            $totalDistance = 0;
            for ($i = 0; $i < count($path) - 1; $i++) {
                $totalDistance += $this->utility_service->findDistanceByHaversine(
                    $path[$i]['latitude'],
                    $path[$i]['longitude'],
                    $path[$i + 1]['latitude'],
                    $path[$i + 1]['longitude']
                );
            }
            return $totalDistance;
        };

        // Function to generate all permutations of locations
        $generatePermutations = function ($items, $perms = []) use (&$generatePermutations) {
            if (empty($items)) {
                return [$perms];
            }
            $permutations = [];
            for ($i = count($items) - 1; $i >= 0; --$i) {
                $newitems = $items;
                $newperms = $perms;
                list($tmp) = array_splice($newitems, $i, 1);
                array_unshift($newperms, $tmp);
                $permutations = array_merge($permutations, $generatePermutations($newitems, $newperms));
            }
            return $permutations;
        };

        $shortestPath = null;
        $shortestDistance = PHP_INT_MAX;

        // Generate all permutations of the remaining locations
        $permutations = $generatePermutations($remainingLocations);

        foreach ($permutations as $permutation) {
            array_unshift($permutation, $currentLocation); // Start from the current location
            $totalDistance = $calculateTotalDistance($permutation);

            if ($totalDistance < $shortestDistance) {
                $shortestDistance = $totalDistance;
                $shortestPath = $permutation;
            }
        }

        // Remove the starting location from the path before returning
        array_shift($shortestPath);
        return $shortestPath;
    }

    public function sortedLocationsByGeneticAlgorithm($location, $locations, $populationSize = 30, $generations = 100, $mutationRate = 0.01)
    {
        $locationsArray = $locations->toArray();
        array_unshift($locationsArray, $location); // Include the starting location

        // Create initial population
        $population = $this->utility_service->createPopulation($locationsArray, $populationSize);

        // Track the best route found
        $bestRoute = null;
        $bestFitness = -PHP_INT_MAX;

        // Evolve the population over generations
        for ($i = 0; $i < $generations; $i++) {
            // Calculate fitness scores for the population
            $fitnessScores = $this->utility_service->calculateFitness($population);

            // Find the best route in the current population
            $currentBestFitness = max($fitnessScores);
            $currentBestRouteIndex = array_search($currentBestFitness, $fitnessScores);
            if ($currentBestFitness > $bestFitness) {
                $bestFitness = $currentBestFitness;
                $bestRoute = $population[$currentBestRouteIndex];
            }

            // Select mating pool from the current population
            $matingPool = $this->utility_service->selection($population, $fitnessScores);

            // Create the next generation
            $population = $this->utility_service->createNextGeneration($matingPool, $mutationRate);

            // Free memory by unsetting variables that are no longer needed
            unset($fitnessScores);
            unset($matingPool);
        }

        // Remove the starting location from the result
        array_shift($bestRoute);

        return $bestRoute;
    }
}
