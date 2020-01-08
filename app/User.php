<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function projects()
    {
        return $this->belongsToMany('App\Project');

    }
    public function memories()
    {
        return $this->hasMany('App\Memory');
    }

    public function scopeShared($query, $myname, $project)
    {
        $sharing = array();
       $user = User::all();
       foreach($user as $u) {
           foreach($u->projects as $p) {
               if ($p->id == $project->id) {
                   array_push($sharing, $u->name);
               }
           }
       }

       if (($key = array_search($myname, $sharing)) !== false) {
           unset($sharing[$key]);
       }
       return $sharing;
    }
}
