<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class RoadProblemTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       \App\RoadProblemType::create(['name'=>'Покраска дорожней разметки']);
       \App\RoadProblemType::create(['name'=>'Устранение внеплановых повреждений дорожнего покрытия']);
       \App\RoadProblemType::create(['name'=>'Плановые ремонтные работы']);
       \App\RoadProblemType::create(['name'=>'Устранение гололеда']);
    }
}
