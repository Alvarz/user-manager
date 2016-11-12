<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
  protected function facilities()
  {
    return $this->hasMany('App\Properties_facilities');
  }

  protected function states()
  {
    return $this->hasOne('App\states');
  }
}
