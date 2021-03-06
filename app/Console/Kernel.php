<?php

namespace App\Console;

use App\Jobs\GetCityDisplayInfoJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        'App\Console\Commands\GetCitiesInfo',
        'App\Console\Commands\GetKeywordsInfo',
        'App\Console\Commands\MinuteTick',
        'App\Console\Commands\pushHaojing',
        'App\Console\Commands\GetBaiduIndex',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->command('eagle:hunt')->dailyAt('10:00');
        $schedule->command('eagle:eat')->dailyAt('8:00');
        $schedule->command('eagle:getBaiduIndex')->dailyAt('7:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }

	/**
     * 鹰眼捕猎行动
     */
    protected function hunt() {
        $job = (new GetCityDisplayInfoJob('shanghai'))->onQueue('hunt');
        dispatch($job);
    }
}
