<?php

namespace App\Console;

use App\Imports\CoronaStatsImport;
use App\RegionStat;
use App\Services\GenerateTotalCasesImage;
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
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            /**
             * Update database
             */
            $response = Zttp::get('https://www.arcgis.com/sharing/rest/content/items/b5e7488e117749c19881cce45db13f7e/data')->body();
            Storage::disk('local')->put('corona-stats.xlsx', $response);

            $import = new CoronaStatsImport();
            $import->onlySheets('Regions');

            Excel::import($import, storage_path('app/corona-stats.xlsx'));

            /**
             * Generate and store image
             */
            $image = GenerateTotalCasesImage::make(RegionStat::regionsTotalCases(), RegionStat::regionsTotalDeaths());

            File::isDirectory(public_path('stats')) or File::makeDirectory(public_path('stats'), 0777, true, true);

            $image->save(public_path('stats/total.png'));
        })->dailyAt('14:00')->timezone('Europe/Stockholm');
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
