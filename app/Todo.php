<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $guarded = [];

    public function projects()
    {
        return $this->belongsTo('App\Project');
    }
}
