<?php

use App\Imports\CoronaStatsImport;
use App\RegionStat;
use App\Services\GenerateTotalCasesImage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;
use Zttp\Zttp;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function() {
    $job = new \App\Jobs\ScrapeSuggestions();
    $job->handle();

    die();

    return GenerateTotalCasesImage::make(RegionStat::regionsTotalCases(), RegionStat::regionsTotalDeaths())
        ->response('png');
});

Route::view('/', 'home');
