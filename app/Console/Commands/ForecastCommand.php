<?php

namespace App\Console\Commands;

use App\Humidity;
use App\Services\Forecasts\ForecastService;
use Illuminate\Console\Command;

class ForecastCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forecast:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run forecast';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $forecastService = new ForecastService();
        $forecastService->run();
    }
}
