<?php


namespace App\Services\Forecasts;
use App\AirTemperature;
use App\AtmospherePressure;
use App\Forecast;
use App\ForecastDetails;
use App\Humidity;


class RoadIceForecast extends AbstractForecast
{
    function run()
    {
        //conditions
        // рост атмосферного давления, понижение температуры воздуха, понижение относительной влажности воздуха
        $pressure = AtmospherePressure::where('station_id', $this->stationId)->latest('measured_at')->take(10)->get();
        $airTemperature = AirTemperature::where('station_id', $this->stationId)->latest('measured_at')->take(10)->get();
        $humidity = Humidity::where('station_id', $this->stationId)->latest('measured_at')->take(10)->get();

        if ($this->isGrowing($pressure) &&
            $this->isDecaying($airTemperature) &&
            $this->isDecaying($humidity)
        ) {
            $this->success();
        } else {
            $this->fail();
        }
    }
    public function success()
    {
        $this->forecastModel->ice='1';
    }
    public function fail()
    {
        $this->forecastModel->ice='0';
    }
}
