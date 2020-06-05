<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function articles()
    {
        return $this->belongsTo('App\Article');
    }
}
