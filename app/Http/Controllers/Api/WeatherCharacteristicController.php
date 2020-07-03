<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WeatherCharacteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WeatherCharacteristicController extends Controller
{
    /**
     * Get outlet listing on Leaflet JS geoJSON data structure.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function store(Request $request)
    {
        Log::info($_REQUEST);
        $dataRequest =[
            ['value'=>$request->get('humidity'),'type'=>'\App\Humidity'],
            ['value'=>$request->get('pressure'),'type'=>'\App\AtmospherePressure'],
            ['value'=>(int)($request->get('precipitation')/10),'type'=>'\App\Precipitation'],
            ['value'=>$request->get('airTemperature'),'type'=>'\App\AirTemperature'],
            ['value'=>$request->get('roadTemperature',$request->get('airTemperature')+1),'type'=>'\App\RoadTemperature']
        ];

        $station_id = $request->get('station_id');
        $measured_at = $request->get('measured_at',now());
//        return $request->all();
        $measures  =$request->get('measures',$dataRequest);
        $data = [];
        foreach ($measures as $measure){
            $data[] =[
                'station_id' =>$station_id,
                'value' => $measure['value'],
                'type' => $measure['type'],
                'measured_at' => $measured_at
            ];
        }
        Log::info($data);
//        WeatherCharacteristic::insert($data);

        return true;
    }
}
