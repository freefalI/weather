<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForecastDetails extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forecast_id','rain','ice',
    ];

}
