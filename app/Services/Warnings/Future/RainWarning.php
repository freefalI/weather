<?php


namespace App\Services\Warnings\Future;


use App\Services\Warnings\PresentWarning;

class RainWarning extends  PresentWarning
{
    private $title = 'future.rain';

    public function get()
    {
        if ($this->condition()) {
            return $this->title;
        } else return null;
    }

    public function condition()
    {
        return 1;
    }
}
