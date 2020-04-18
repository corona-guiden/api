<?php

namespace App\Console\Commands;

use App\Imports\CoronaStatsImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Zttp\Zttp;

class ImportStatistics extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports regions to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->line('Importing stats from FOHM...');

        $response = Zttp::get('https://www.arcgis.com/sharing/rest/content/items/b5e7488e117749c19881cce45db13f7e/data')->body();
        Storage::disk('local')->put('corona-stats.xlsx', $response);

        Excel::import(new CoronaStatsImport, storage_path('app/corona-stats.xlsx'));

        // Clear cache
        Cache::forget('stats.regions.all');

        $this->info('Done');
    }
}
