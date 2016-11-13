<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'created_at', 'updated_at', 'id'
  ];

  /**
   *
   * @return App\Properties_facilities
   */
  protected function properties()
  {
    return $this->belongsToMany('App\Properties_facilities');
  }
}
