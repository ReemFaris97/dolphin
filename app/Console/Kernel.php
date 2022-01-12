<?php

namespace App\Console;

use App\Http\Controllers\Distributor\DistributorRoutesController;
use App\Models\DistributorRouteReport;
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
        Commands\AssetDay::class,
        Commands\AssetWeek::class,
        Commands\AssetMonthly::class,
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



        $schedule->command('assetDay:cron')
        ->daily();


        $schedule->command('assetWeek:cron')
        ->weeklyOn(5, '8:00');

        $schedule->command('assetMonthly:cron')
        ->monthlyOn(1, '8:00');

        // $schedule->call(function () {
        //    $unfinished_report_id= DistributorRouteReport->where('finish_report_id',null)->pluck(['dr_id']);
        //    app(DistributorRoutesController::class)->closeRoutes($unfinished_report_id);
        // })->dailyAt('00:00');
    }
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
