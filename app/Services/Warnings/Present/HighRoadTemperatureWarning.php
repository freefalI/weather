<?php


namespace App\Services\Warnings\Present;


use App\Services\Warnings\PresentWarning;

class HighRoadTemperatureWarning extends PresentWarning
{

    private $title = 'now.high_road_temperature';

    public function get()
    {
        if ($this->condition()) {
            return $this->title;
        }
    }

    public function condition()
    {
        return 1;
    }
}
