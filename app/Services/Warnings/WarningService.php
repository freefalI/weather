<?php


namespace App\Services\Warnings;


use App\Services\Warnings\Future\RoadIceWarning;
use App\Services\Warnings\Present\HighRoadTemperatureWarning;

class WarningService
{

    public $warningsAboutFuture;
    public $warningsAboutPresent;
    public $stationId;

    public function __construct($stationId)
    {
        $this->stationId = $stationId;
        $this->warningsAboutFuture = [
            'App\Services\Warnings\Future\RainWarning',
            RoadIceWarning::class
        ];

        $this->warningsAboutPresent = [
            HighRoadTemperatureWarning::class,
            'App\Services\Warnings\Present\RainWarning',
        ];
    }

    public function getWarnings()
    {
        $presentWarnings = [];
        foreach ($this->warningsAboutPresent as $warningClass) {
            $presentWarnings[] = (new $warningClass($this->stationId))->get();
        }

        $futureWarnings = [];
        foreach ($this->warningsAboutFuture as $warningClass) {
            $futureWarnings[] = (new $warningClass($this->stationId))->get();
        }

        return array_merge($presentWarnings, $futureWarnings);
    }
}
