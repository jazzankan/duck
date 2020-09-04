<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projcomment extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
