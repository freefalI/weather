<?php


namespace App\Services\Warnings;


abstract class  Warning
{
    public $stationId;

    public function __construct($stationId)
    {
        $this->stationId = $stationId;

    }

    abstract public function condition();

    abstract public function get();
}
