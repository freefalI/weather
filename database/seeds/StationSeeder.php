<?php

use Illuminate\Database\Seeder;

class StationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Station::class, 30)->create();
    }
}
