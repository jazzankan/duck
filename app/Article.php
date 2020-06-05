<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsTo('App\Category');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
