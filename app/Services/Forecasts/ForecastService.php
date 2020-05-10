<?php


namespace App\Services;


class ForecastService
{
    private $forecasts;

    public function __construct()
    {
        $this->forecasts[] = [

        ];
    }

    public function run()
    {
        foreach ($this->forecasts as $forecast){
            $forecast->run();
        }
    }
}
