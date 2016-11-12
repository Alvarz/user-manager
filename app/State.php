<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected function properties()
    {
      return $this->belongsToMany('App\Property');
    }
}
