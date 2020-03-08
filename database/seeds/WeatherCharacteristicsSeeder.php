<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class WeatherCharacteristicsSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\WeatherCharacteristic::truncate();
        $characteristics = [
            \App\Humidity::class,
            \App\Precipitation::class,
            \App\AirTemperature::class,
            \App\RoadTemperature::class,
            \App\AtmospherePressure::class,
        ];

        $stations = \App\Station::all();
        dump($stations->count());
        $timeMin = Carbon::now()->subDays(20);
        echo $timeMin->toDateString();
        $data = [[], [], [], [], []];
        foreach ($stations as $station) {
            dump($station->name);
//            dump($timeMin->toDateTimeString());

            for ($date = clone $timeMin; $date < Carbon::now(); $date = $date->addDay()) {
//                dump($date->toDateTimeString());
                $data[0][] = [
                    'station_id' => $station->id,
                    'value' => random_int(20, 100),
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\Humidity'
                ];
                $data[1][] = [
                    'station_id' => $station->id,
                    'value' => random_int(20, 100),
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\Precipitation'


                ];
                $data[2][] = [
                    'station_id' => $station->id,
                    'value' => random_int(-50, 50),
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\AirTemperature'

                ];
                $data[3][] = [
                    'station_id' => $station->id,
                    'value' => random_int(-20, 60),
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\RoadTemperature'


                ];
                $data[4][] = [
                    'station_id' => $station->id,
                    'value' => random_int(100, 1000),
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\AtmospherePressure'


                ];
            }
        }
        \App\Humidity::insert($data[0]);
        \App\Precipitation::insert($data[1]);
        \App\AirTemperature::insert($data[2]);
        \App\RoadTemperature::insert($data[3]);
        \App\AtmospherePressure::insert($data[4]);
    }
}
