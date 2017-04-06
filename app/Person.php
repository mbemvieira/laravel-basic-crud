<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public function administrator()
    {
        return $this->belongsTo('App\User');
    }
    public function emails()
    {
        return $this->hasMany('App\Email');
    }
    public function phones()
    {
        return $this->hasMany('App\Telephone');
    }
}
