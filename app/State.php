<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
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
   * @return App\Property
   */
    protected function properties()
    {
      return $this->belongsToMany('App\Property');
    }
}
