<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $guarded = [];

    public function qna()
    {
        return $this->belongsTo(QNA::class);
    }
}
