<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * The app console.
 */
class Kernel extends ConsoleKernel
{
    /** @var array $commands The Artisan commands provided by your application. */
    protected $commands = [];

    /**
     * Define the application's command schedule.
     * 
     * @param \Illuminate\Console\Scheduling\Schedule $schedule The command schedule.
     *
     * @return void Returns nothing.
     */
    protected function schedule(Schedule $schedule) { }

    /**
     * Register the commands for the application.
     *
     * @return void Returns nothing.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');
        require base_path('routes/console.php');
    }
}
