<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\WeatherCharacteristic;
use Illuminate\Http\Request;

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
        $station_id = $request->get('station_id');
        $measured_at = $request->get('measured_at');
//        return $request->all();
        $measures  =$request->get('measures');
        $data = [];
        foreach ($measures as $measure){
            $data[] =[
                'station_id' =>$station_id,
                'value' => $measure['value'],
                'type' => $measure['type'],
                'measured_at' => $measured_at
            ];
        }

        WeatherCharacteristic::insert($data);

        return true;
    }
}
