<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\DomCrawler\Crawler;

Route::view('/', 'home');

//Route::get('test', function() {
//    $url = 'https://www.1177.se/stockholm/sjukdomar--besvar/lungor-och-luftvagar/inflammation-och-infektion-ilungor-och-luftror/covid-19-coronavirus/';
//
//    $job = new \App\Jobs\ScrapeWebsiteMonitors($url, '.c-articlefooter__wrapper .c-articlefooter__value', '#content');
//
//    $job->handle();
//});
