<?php

namespace App\Console;

use Exception;
use App\Jobs\DailyReports;
use App\Jobs\Heartbeat;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Create a database record of crypto prices every minute
        $schedule->job(new Heartbeat)->everyMinute();
        // Cryptocurrency analysis sent over email
        $schedule->job(new DailyReports)->timezone('America/Phoenix')->hourlyAt('0');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
