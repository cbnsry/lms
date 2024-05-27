<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{

    public function indexLocation()
    {
        return Location::all();
    }

    public function storeLocation($data)
    {
        return Location::create($data);
    }

    public function showLocation(string $id)
    {
        return Location::find($id);
    }

    public function updateLocation($data, $id)
    {
        $location = Location::findOrFail($id);
        $location->update($data);
        return $location;
    }

    public function deleteLocation($id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return $location;
    }
}
