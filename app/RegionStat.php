<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionStat extends Model
{
    protected $guarded = [];

    protected $hidden = ['id', 'created_at'];

    protected $casts = [
        'infected' => 'integer',
        'infected_per_100000_ppl' => 'integer',
        'intensive_care' => 'integer',
        'deceased' => 'integer',
    ];

    public static function regionsTotalCases()
    {
        return static::all()->sum('infected');
    }

    public static function regionsTotalDeaths()
    {
        return static::all()->sum('deceased');
    }
}
