<?php


namespace App\Services\Forecasts;
use App\AirTemperature;
use App\AtmospherePressure;
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
            $this->isDecaying($humidity) &&
            $this->getIcePrediction($airTemperature->last()->value, $humidity->last()->value)
        ) {
            $this->success();
        } else {
            $this->fail();
        }
    }

    public function success()
    {
        $this->forecastModel->ice = '1';
    }

    public function fail()
    {
        $this->forecastModel->ice = '0';
    }

    public function getIcePrediction($Tv, $W)
    {
        $Y = 0.092 * $Tv + 0.104 * $W - 9.142;
        return $W > 60 && $Y > 0;

    }
}
