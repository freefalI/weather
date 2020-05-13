<?php

namespace App\Http\Controllers;

use App\AirTemperature;
use App\AtmospherePressure;
use App\Humidity;
use App\Precipitation;
use App\RoadTemperature;
use App\Services\Warnings\WarningService;
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


        $stats['min_humidity'] = round(Humidity::min('value'), 1);
        $stats['min_pressure'] = round(AtmospherePressure::min('value'), 1);
        $stats['min_precipitation'] = round(Precipitation::min('value'), 1);
        $stats['min_air_temperature'] = round(AirTemperature::min('value'), 1);
        $stats['min_road_temperature'] = round(RoadTemperature::min('value'), 1);


        $stats['max_humidity'] = round(Humidity::max('value'), 1);
        $stats['max_pressure'] = round(AtmospherePressure::max('value'), 1);
        $stats['max_precipitation'] = round(Precipitation::max('value'), 1);
        $stats['max_air_temperature'] = round(AirTemperature::max('value'), 1);
        $stats['max_road_temperature'] = round(RoadTemperature::max('value'), 1);


        $stats['average conditions'] = round(RoadTemperature::max('value'), 1);
        $stations = Station::all();
        $badConditions =0;
        foreach ( $stations as $station) {
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
            if($status)$badConditions++;
//            $station->status = $status ? 'Danger' : 'Safe';
//            $station->statusColor = $statusColors[$status];
        }
        if($badConditions>  $stats['total_stations']/2 ){
            $stats['average_conditions'] ='Bad';
        }else{
            $stats['average_conditions'] = 'Good';
        }
        return view('stats', ['stats' => $stats]);

    }
}
