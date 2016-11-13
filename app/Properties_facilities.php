<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties_facilities extends Model
{
    //
    protected $fillable = ['property_id', 'facility_id'];


    protected function properties()
    {
      return $this->belongsToMany('App\Properties');
    }

    protected function facility()
    {
      return $this->hasMany('App\Facilities', 'id', 'facility_id');
    }
}
