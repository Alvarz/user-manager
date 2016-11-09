<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
    /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
    protected $fillable = [
      'id', 'name', 'api_token', 'url', 'client_id'
    ];

    /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
    protected $hidden = [
      'api_token'
    ];

    public function Deposits()
    {
        return $this->hasMany('App\Deposits', 'client_id', 'client_id');
    }

    public function Withdrawal()
    {
        return $this->hasMany('App\withdrawal', 'client_id', 'client_id');
    }
}
