<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function todos()
    {
        return $this->hasMany('App\Todo');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }
    public function projcomments()
    {
        return $this->hasMany('App\Projcomment');
    }
}
