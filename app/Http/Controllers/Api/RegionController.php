<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RegionStat;
use Illuminate\Support\Facades\Cache;

class RegionController extends Controller
{
    public function __invoke($region)
    {
        return Cache::rememberForever('stats.regions.' . $region, function () use ($region) {
            return RegionStat::where('region', $region)
                ->firstOrFail()
                ->makeHidden('region');
        });
    }
}
