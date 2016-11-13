<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{


  protected $fillable = [
      'title', 'description', 'address', 'town', 'country', 'county', 'state_id'
  ];


  protected function facilities()
  {
    return $this->hasMany('App\Properties_facilities');
  }

  protected function state()
  {
    return $this->hasOne('App\State', 'id', 'state_id');
  }
}
