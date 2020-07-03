<?php

namespace App\Http\Controllers\Api;

use App\Services\Warnings\WarningService;
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
            $warningService = new WarningService($station->id);
            $warnings = $warningService->getWarnings();
            $status = 0;//all is ok
            if ($warnings) $status = 1; // danger
            $statusColors = [
                '#75ff0085',
                '#ff000085'
            ];
            $statusTexts = [
                'Safe conditions on the road',
                'Danger conditions on the road!',
            ];
            $station->status = $status ? 'Danger' : 'Safe';
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
                //'status'=>   $status ? 'Danger' : 'Safe'

            ];
        });

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $geoJSONdata,
        ]);
    }
}
