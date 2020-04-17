<?php

namespace App\Console;

use App\Services\GenerateTotalCasesImage;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
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
            $url = 'https://api.covid19api.com/live/country/sweden';
            $response = Zttp::get($url)->json();
            $stats = collect($response)->last();

            $image = GenerateTotalCasesImage::make($stats['Confirmed'], $stats['Deaths']);

            File::isDirectory(public_path('stats')) or File::makeDirectory(public_path('stats'), 0777, true, true);

            $image->save(public_path('stats/total.png'));
        })->everyFiveMinutes();
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
