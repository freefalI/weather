<?php

namespace App\Http\Controllers\Api;

use App\Station;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Station as StationResource;

class StationController extends Controller
{
    /**
     * Get station listing on Leaflet JS geoJSON data structure.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $stations = Station::all();

        $geoJSONdata = $stations->map(function ($station) {
            return [
                'type'       => 'Feature',
                'properties' => new StationResource($station),
                'geometry'   => [
                    'type'        => 'Point',
                    'coordinates' => [
                        $station->longitude,
                        $station->latitude,
                    ],
                ],
            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
