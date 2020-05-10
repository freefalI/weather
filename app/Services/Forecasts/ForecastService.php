<?php


namespace App\Services\Forecasts;


use App\Forecast;
use App\ForecastDetails;
use App\Station;

class ForecastService
{
    private $forecasts;

    public function __construct()
    {
        $this->forecasts = [
            RoadIceForecast::class
        ];
    }

    public function run()
    {
        $stations = Station::all();
        foreach ($stations as $station) {
            $forecast= Forecast::create(['station_id'=>$station->id]);
            $forecastModel = new  ForecastDetails(['forecast_id'=>$forecast->id]);

            foreach ($this->forecasts as $forecastClass) {
                (new  $forecastClass($forecastModel,$station->id))->run();
            }
            $forecastModel->save();
        }
    }
}
