<?php

namespace App\Console;

use App\Imports\CoronaStatsImport;
use App\Jobs\GenerateImages;
use App\Jobs\ImportStatistics;
use App\Jobs\ScrapeSuggestions;
use App\Jobs\ScrapeWebsiteMonitors;
use App\RegionStat;
use App\Services\GenerateTotalCasesImage;
use App\WebsiteMonitor;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Zttp\Zttp;

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
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            WebsiteMonitor::all()->each->scrape();
        })->hourly();

        $schedule->job(ScrapeSuggestions::class)->everyFiveMinutes();
        $schedule->job(ImportStatistics::class)->dailyAt('14:01')->timezone('Europe/Stockholm');
        $schedule->job(GenerateImages::class)->dailyAt('14:01')->timezone('Europe/Stockholm');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
