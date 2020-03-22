<?php

use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       \App\Task::create([
           'description'=>'Problem description',
           'comment'=>'comment',
           'problem_type_id'=>\App\RoadProblemType::first()->id,
           'latitude1'=>\App\Station::find(1)->latitude,
           'latitude2'=>\App\Station::find(2)->latitude,
           'longitude1'=>\App\Station::find(1)->longitude,
           'longitude2'=>\App\Station::find(2)->longitude,
//           'creator_id'=>auth()->user()->id,
           'creator_id'=>\App\User::first()->id,
       ]);
    }
}
