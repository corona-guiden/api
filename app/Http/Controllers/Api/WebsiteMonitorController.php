<?php

namespace App\Http\Controllers\Api;

use App\Jobs\ScrapeWebsiteMonitors;
use App\WebsiteMonitor;
use Illuminate\Http\Request;

class WebsiteMonitorController
{
    /**
     * Display a listing of the resource.
     *
     * @return WebsiteMonitor[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return WebsiteMonitor::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return WebsiteMonitor
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'url' => 'required|url',
            'dateSelector' => 'required|string',
            'contentSelector' => 'required|string',
        ]);

        $job = new ScrapeWebsiteMonitors($data['url'], $data['dateSelector'], $data['contentSelector']);

        return $job->handle();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WebsiteMonitor  $websiteMonitor
     * @return \Illuminate\Http\Response
     */
    public function show(WebsiteMonitor $websiteMonitor)
    {
        return $websiteMonitor;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WebsiteMonitor  $websiteMonitor
     * @return WebsiteMonitor
     */
    public function update(Request $request, WebsiteMonitor $websiteMonitor)
    {
        $websiteMonitor->update($request->only('status'));

        return $websiteMonitor;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\WebsiteMonitor $websiteMonitor
     * @return void
     * @throws \Exception
     */
    public function destroy(WebsiteMonitor $websiteMonitor)
    {
        abort_if(!$websiteMonitor->delete(), 500);
    }
}
