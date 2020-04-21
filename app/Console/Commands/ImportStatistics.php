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

        \App\Jobs\ImportStatistics::dispatchNow();

        $this->info('Done');
    }
}
