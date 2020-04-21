<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteMonitor extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    protected $dates = ['crawled_at', 'source_updated_at'];
}
