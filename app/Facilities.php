<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
  protected function properties()
  {
    return $this->belongsToMany('App\Properties_facilities');
  }
}
