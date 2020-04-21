<?php

namespace App\Console\Commands;

use App\RegionStat;
use App\Services\GenerateTotalCasesImage as GenerateTotalCasesImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateTotalCasesImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-image:total-cases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates an image of the total cases in public/stats';

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
        $this->line('Generating image...');

        GenerateTotalCasesImageService::make(RegionStat::regionsTotalCases(), RegionStat::regionsTotalDeaths())->save();

        $this->info('Done');
    }
}
