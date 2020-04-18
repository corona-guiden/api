<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionStat extends Model
{
    protected $guarded = [];

    protected $hidden = ['id', 'created_at'];

    protected $casts = [
        'total_cases' => 'integer',
        'cases_per_1m' => 'integer',
        'critical_cases' => 'integer',
        'deaths' => 'integer',
    ];

    public static function regionsTotalCases()
    {
        return static::all()->sum('total_cases');
    }

    public static function regionsTotalDeaths()
    {
        return static::all()->sum('deaths');
    }
}
