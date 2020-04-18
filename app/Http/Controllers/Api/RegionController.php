<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RegionStat;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function __invoke($region)
    {
        return RegionStat::where('region', $region)
            ->firstOrFail()
            ->makeHidden('region');
    }
}
