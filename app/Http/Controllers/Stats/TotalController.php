<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Services\GenerateTotalCasesImage;
use Illuminate\Support\Facades\Cache;
use Zttp\Zttp;

class TotalController extends Controller
{
    public function index()
    {
        $minutesToCache = 15;

        return Cache::remember('total-cases-image', 60 * $minutesToCache, function() {
            $url = 'https://api.covid19api.com/live/country/sweden';
            $response = Zttp::get($url)->json();
            $stats = collect($response)->last();
            return GenerateTotalCasesImage::make($stats['Confirmed'], $stats['Deaths']);
        });
    }
}
