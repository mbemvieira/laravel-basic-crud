<?php

namespace App;

use App\Permission;
use App\Role;
use Illuminate\Notifications\Notifiable;
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

    public function people()
    {
        return $this->hasMany('App\Person');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasPermission(Permission $permission) {
        if ( !$permission->roles->isEmpty() ) {
            return ( $this->roles->intersect($permission->roles)
                ->count() > 0 );
        }
        return false;
    }
}
