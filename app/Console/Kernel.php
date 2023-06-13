<?php

namespace App\Console;

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
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->call(function () {
        //Récupération des cours publiés obsolète
            Programme::where('public', 'true')
            ->where('type_programme', '1')
            ->where('dateFin', '<', today())
            ->update(['public' => 'false']);   

        //Récupération des examens publiés obsolète
            Programme::where('public', 'true')
            ->where('type_programme', '2')
            ->where('dateDebut', '<', today())
            ->update(['public' => 'false']);
        })->weekly();
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
