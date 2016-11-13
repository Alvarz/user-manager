<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{

  /**
   * The attributes that should be fill for arrays.
   *
   * @var array
   */
  protected $fillable = [
      'title', 'description', 'address', 'town', 'country', 'county', 'state_id'
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'created_at', 'updated_at',
  ];

  /**
   *
   * @return App\Properties_facilities
   */
  protected function facilities()
  {
    return $this->hasMany('App\Properties_facilities');
  }

  /**
   *
   * @return App\State
   */
  protected function state()
  {
    return $this->hasOne('App\State', 'id', 'state_id');
  }
}
