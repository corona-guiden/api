<?php

use App\Http\Controllers\Api\AllRegionsController;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\WebsiteMonitorController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SuggestionsController;
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

Route::get('regions/all', AllRegionsController::class);
Route::get('regions/{region}', RegionController::class);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('suggestions', SuggestionsController::class);
    Route::apiResource('website-monitors', WebsiteMonitorController::class);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
