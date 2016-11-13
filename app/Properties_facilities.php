<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties_facilities extends Model
{
    //
    protected $fillable = ['property_id', 'facility_id'];


    /**
     *
     * @return App\Properties
     */
    protected function properties()
    {
      return $this->belongsToMany('App\Properties');
    }

    /**
     *
     * @return App\Facilities
     */
    protected function facility()
    {
      return $this->hasMany('App\Facilities', 'id', 'facility_id');
    }
}
