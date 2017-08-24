<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Person extends Model
{
    use Searchable;

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
