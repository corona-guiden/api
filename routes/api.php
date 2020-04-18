<?php

use App\RegionStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('region/all', function() {
    return RegionStat::all();
});

Route::get('region/{region}', function($region) {
    return RegionStat::where('region', $region)
        ->firstOrFail()
        ->makeHidden('region');
});
