<?php


namespace App\Services\Forecasts;

use MathPHP\NumericalAnalysis\Interpolation;


abstract class AbstractForecast
{
    public $forecastModel;
    public $stationId;

    public function __construct($forecastModel,$stationId)
    {
        $this->forecastModel = $forecastModel;
        $this->stationId = $stationId;
    }

    public function isGrowing($data)
    {
        $index = 1;
        foreach ($data as $dataItem) {
            $points[] = [$index++, (float)$dataItem->value];
        }
        $indexMiddle = (int)(count($points) / 2);
        $p = Interpolation\LagrangePolynomial::interpolate($points);

        $derivative = $p->differentiate();
        return $derivative($points[$indexMiddle][1]) > 0;
    }

    public function isDecaying($data)
    {
        $index = 1;
        foreach ($data as $dataItem) {
            $points[] = [$index++, (float)$dataItem->value];
        }
        $indexMiddle = (int)(count($points) / 2);
        $p = Interpolation\LagrangePolynomial::interpolate($points);

        $derivative = $p->differentiate();
        return $derivative($points[$indexMiddle][1]) < 0;
    }
}
