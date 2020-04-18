<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\RegionStat;
use Illuminate\Http\Request;

class AllRegionsController extends Controller
{
    public function __invoke()
    {
        return RegionStat::all();
    }
}
