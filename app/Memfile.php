<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memfile extends Model
{
    protected $guarded = [];

    public function memories()
    {
        return $this->belongsTo('App\Memory');
    }
}
