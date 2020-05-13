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
        $timeMin = Carbon::now()->subDays(1);
        echo $timeMin->toDateString();
        $data = [[], [], [], [], []];
        foreach ($stations as $station) {
            dump($station->name);
//            dump($timeMin->toDateTimeString());

            for ($date = clone $timeMin; $date < Carbon::now(); $date = $date->addHour()) {
//                dump($date->toDateTimeString());
                if (count($data[0])) {
                    $prev = $data[0][count($data[0]) - 1]['value'];
                    dump($prev);
//                    if($prev>25 && $prev < 95) {
                    $newNumber = random_int($prev - 10, $prev + 10);
//                    }
//                    $newNumber =random_int($prev-5, $prev+5);
                } else {
                    $newNumber = random_int(40,60);
                }
                $data[0][] = [
                    'station_id' => $station->id,
                    'value' => $newNumber,
                    'measured_at' => $date->toDateTimeString(),
                    'type' => 'App\Humidity'
                ];

                if (count($data[1])) {
                    $prev = $data[1][count($data[1]) - 1]['value'];
                    dump($prev);
//                    if($prev>25 && $prev < 95) {
                    $newNumber = random_int($prev - 10, $prev + 10);
//                    }
//                    $newNumber =random_int($prev-5, $prev+5);
                } else {
                    $newNumber = random_int(20,100);

                }
                $data[1][] = [
                    'station_id' => $station->id,
                    'value' => $newNumber,
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\Precipitation'


                ];

                if (count($data[2])) {
                    $prev = $data[2][count($data[2]) - 1]['value'];
                    dump($prev);
//                    if($prev>25 && $prev < 95) {
                    $newNumber = random_int($prev - 10, $prev + 10);
//                    }
//                    $newNumber =random_int($prev-5, $prev+5);
                } else {
                    $newNumber = random_int(10,20);

                }
//                dd($newNumber);
                $data[2][] = [
                    'station_id' => $station->id,
                    'value' => $newNumber,
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\AirTemperature'

                ];
//
//                if (count($data[3])) {
//                    $prev = $data[3][count($data[3]) - 1]['value'];
//                    dump($prev);
//
////                    if($prev>25 && $prev < 95) {
//                    $newNumber = random_int($prev - 10, $prev + 10);
////                    }
////                    $newNumber =random_int($prev-5, $prev+5);
//                } else {
//                    $newNumber = random_int(10,15);
//
//                }
                $num =  $data[2][count($data[2])-1]['value'];
                $newNumber = random_int($num - 2, $num +2);
                $data[3][] = [
                    'station_id' => $station->id,
                    'value' => $newNumber,
                    'measured_at' => $date->toDateTimeString(),
                    'type'=>'App\RoadTemperature'


                ];

                if (count($data[4])) {
                    $prev = $data[4][count($data[4]) - 1]['value'];
                    dump($prev);
//                    if($prev>25 && $prev < 95) {
                    $newNumber = random_int($prev - 10, $prev + 10);
//                    }
//                    $newNumber =random_int($prev-5, $prev+5);
                } else {
                    $newNumber = random_int(600,800);

                }
                $data[4][] = [
                    'station_id' => $station->id,
                    'value' => $newNumber,
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
