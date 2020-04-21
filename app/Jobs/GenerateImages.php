<?php

namespace App\Jobs;

use App\Console\Commands\GenerateTotalCasesImage;
use App\RegionStat;
use App\Services\GenerateTotalCasesImage as GenerateTotalCasesImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateImages implements ShouldQueue
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
        GenerateTotalCasesImageService::make(RegionStat::regionsTotalCases(), RegionStat::regionsTotalDeaths())->save();
    }
}
