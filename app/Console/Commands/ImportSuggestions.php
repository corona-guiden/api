<?php

namespace App\Console\Commands;

use App\Imports\CoronaStatsImport;
use App\Jobs\ScrapeSuggestions;
use Illuminate\Console\Command;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Queue\Queue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Zttp\Zttp;

class ImportSuggestions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:suggestions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports suggestions to database';

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
        $this->line('Importing QNA suggestions from FOHM...');

        $job = new ScrapeSuggestions();
        $job->handle();

        $this->info('Done');
    }
}
