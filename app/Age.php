<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Age extends Model
{
    protected $fillable=['age'];

    public function profile(){
        return $this->hasMany('App/Profile');
    }
}
