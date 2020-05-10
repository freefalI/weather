<?php


namespace App\Services\Warnings\Present;


use App\RoadTemperature;
use App\Services\Warnings\PresentWarning;

class HighRoadTemperatureWarning extends PresentWarning
{

    private $title = 'now.high_road_temperature';
    private $threshold = 30;

    public function get()
    {
        if ($this->condition()) {
            return $this->title;
        } else return null;
    }

    public function condition()
    {
        $value = RoadTemperature::where('station_id', $this->stationId)->latest('measured_at')->first();

        return $value->value > $this->threshold;
    }
}
