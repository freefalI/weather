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
//           'area'=>'[]',
//           'creator_id'=>auth()->user()->id,
           'creator_id'=>\App\User::first()->id,
       ]);
    }
}
