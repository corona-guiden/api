<?php

use App\Http\Controllers\Api\AllRegionsController;
use App\Http\Controllers\Api\RegionController;
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

Route::get('regions/all', AllRegionsController::class);
Route::get('regions/{region}', RegionController::class);
