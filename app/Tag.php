<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsToMany('App\Memory');
    }
}
