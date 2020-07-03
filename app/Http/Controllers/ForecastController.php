<?php

namespace App\Http\Controllers;

use App\AirTemperature;
use App\AtmospherePressure;
use App\Humidity;
use App\Precipitation;
use App\RoadTemperature;
use App\Services\Warnings\Future\RoadIceWarning;
use App\Services\Warnings\WarningService;
use App\Station;

class ForecastController extends Controller
{
    public function index()
    {
//        $this->authorize('manage_station');

        $stationQuery = Station::query();
        $stationQuery->where('name', 'like', '%'.request('q').'%');
        $stations = $stationQuery->paginate(25);
        foreach ( $stations as &$station) {
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
            $station->statusColor = $statusColors[$status];

            $station->ice_forecast =(new RoadIceWarning($station->id))->get() ?  '<img style="height: 20px;width:20px;"src="gal2.svg">': '';
            $station->snow_forecast = random_int(0,100)>70 ? '<img style="height: 20px;width:20px;"src="gal2.svg">': '';
            $station->rain_forecast = '';
        }


        return view('forecasts', compact('stations'));
    }
}
