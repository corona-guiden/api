<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RegionStat;
use Illuminate\Support\Facades\Cache;

class AllRegionsController extends Controller
{
    public function __invoke()
    {
        return Cache::rememberForever('stats.regions', function() {
            return RegionStat::all();
        });
    }
}
