<?php


namespace App\Services\Warnings\Future;


use App\Forecast;
use App\Services\Warnings\FutureWarning;

class RoadIceWarning extends  FutureWarning
{
    private $title = 'future.ice';

    public function get()
    {
        if ($this->condition()) {
            return $this->title;
        } else return null;
    }

    public function condition()
    {
        $forecast = Forecast::where('station_id', $this->stationId)->latest()->first();
        $details = $forecast->details;
        return (bool)$details->ice;
    }
}
