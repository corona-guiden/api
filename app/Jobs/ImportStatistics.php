<?php

namespace App\Jobs;

use App\Imports\CoronaStatsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Zttp\Zttp;

class ImportStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $url = 'https://www.arcgis.com/sharing/rest/content/items/b5e7488e117749c19881cce45db13f7e/data';
        $response = Zttp::get($url)->body();

        Storage::disk('local')->put('corona-stats.xlsx', $response);

        Excel::import(new CoronaStatsImport, storage_path('app/corona-stats.xlsx'));

        // Clear cache
        Cache::forget('stats.regions.all');
    }
}
