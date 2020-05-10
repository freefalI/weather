<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'station_id','date', 'time',
    ];
    public function details()
    {
        return $this->hasOne(ForecastDetails::class);
    }

}
