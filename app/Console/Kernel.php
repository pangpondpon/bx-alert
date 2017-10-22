<?php

namespace App\Console;

use App\AutoAlertConfig;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;

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
        if(Schema::hasTable('auto_alert_configs')) {
            $this->schedulePriceAlert($schedule);
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

    private function schedulePriceAlert(Schedule $schedule)
    {
        $configs = AutoAlertConfig::whereValid(true)->get();

        $configs->each(function(AutoAlertConfig $config) use ($schedule) {
            $schedule->command("alert:price {$config->primary} {$config->secondary} {$config->threshold}")->everyMinute();
        });
    }
}
