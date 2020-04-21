<?php

namespace App;

use App\Jobs\ScrapeWebsiteMonitors;
use Illuminate\Database\Eloquent\Model;

class WebsiteMonitor extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $dates = ['crawled_at', 'source_updated_at'];

    public function scrape()
    {
        return ScrapeWebsiteMonitors::dispatch($this->url, $this->date_selector, $this->content_selector);
    }
}
