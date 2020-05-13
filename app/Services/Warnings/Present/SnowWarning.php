<?php


namespace App\Services\Warnings\Present;


use App\AirTemperature;
use App\Precipitation;
use App\Services\Warnings\PresentWarning;

class SnowWarning extends PresentWarning
{
    private $title = 'now.snow';
    private $precipitationThreshold = 50;
    private $temperatureThreshold = 0;

    public function get()
    {
        if ($this->condition()) {
            return $this->title;
        } else return null;
    }

    public function condition()
    {
        $temperatureValue = AirTemperature::where('station_id', $this->stationId)->latest('measured_at')->first()->value;
        $precipitationValue = Precipitation::where('station_id', $this->stationId)->latest('measured_at')->first()->value;

        return $temperatureValue < $this->temperatureThreshold && $precipitationValue >= $this->precipitationThreshold  ;
    }
}
