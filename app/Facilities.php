<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{

  /**
   *
   * @return App\Properties_facilities
   */
  protected function properties()
  {
    return $this->belongsToMany('App\Properties_facilities');
  }
}
