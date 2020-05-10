<?php

namespace App\Http\Controllers;

use App\AirTemperature;
use App\AtmospherePressure;
use App\Humidity;
use App\Precipitation;
use App\RoadTemperature;
use App\Station;

class StatisticController extends Controller
{
    public function index()
    {

        $stats['total_stations'] = Station::count();
        $stats['avg_humidity'] = round(Humidity::avg('value'), 1);
        $stats['avg_pressure'] = round(AtmospherePressure::avg('value'), 1);
        $stats['avg_precipitation'] = round(Precipitation::avg('value'), 1);
        $stats['avg_air_temperature'] = round(AirTemperature::avg('value'), 1);
        $stats['avg_road_temperature'] = round(RoadTemperature::avg('value'), 1);


        return view('stats', ['stats' => $stats]);

    }
}
