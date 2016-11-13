<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Properties_facilities extends Model
{
  /**
   * The attributes that should be fill for arrays.
   *
   * @var array
   */
    protected $fillable = ['property_id', 'facility_id'];

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
