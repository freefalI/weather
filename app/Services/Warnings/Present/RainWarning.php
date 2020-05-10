<?php


namespace App\Services\Warnings\Present;


use App\Precipitation;
use App\Services\Warnings\PresentWarning;

class RainWarning extends PresentWarning
{
    private $title = 'now.rain';
    private $threshold = 50;

    public function get()
    {
        if ($this->condition()) {
            return $this->title;
        } else return null;
    }

    public function condition()
    {
        $value = Precipitation::where('station_id', $this->stationId)->latest('measured_at')->first();

        return $value->value > $this->threshold;
    }
}
