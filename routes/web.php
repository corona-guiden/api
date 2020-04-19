<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('test', function() {
    $job = new \App\Jobs\ScrapeSuggestions();
    $job->handle();
});
