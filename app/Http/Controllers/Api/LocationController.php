<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\LocationService;
use App\Services\RouteService;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    protected $location_service;
    protected $route_service;

    public function __construct(LocationService $location_service, RouteService $route_service)
    {
        $this->location_service = $location_service;
        $this->route_service = $route_service;
    }

    public function index()
    {
        $locations = $this->location_service->indexLocation();
        return response()->json($locations);
    }

    public function store(LocationRequest $request)
    {
        $location = $this->location_service->storeLocation($request->validated());
        return response()->json($location, 201);
    }

    public function show(string $id)
    {
        $location = $this->location_service->showLocation($id);
        if (is_null($location)) return response()->json(['message' => 'Location not found'], 404);
        return response()->json($location);
    }


    public function update(LocationRequest $request, $id)
    {
        $location = $this->location_service->updateLocation($request->validated(), $id);
        return response()->json($location);
    }

    public function destroy($id)
    {
        $location = $this->location_service->deleteLocation($id);
        return response()->json(null, 204);
    }

    public function route($id)
    {
        $location = $this->location_service->showLocation($id);
        if (is_null($location)) return response()->json(['message' => 'Location not found'], 404);
        $locations = $this->location_service->indexLocation();

        $locations = $this->route_service->sortedLocationsByKNN($location, $locations);
        //$locations = $this->route_service->sortedLocationsByGeneticAlgorithm($location, $locations);
        if (is_null($locations)) return response()->json(['message' => 'Optimal route calculation failed'], 500);

        return response()->json($locations);
    }
}
