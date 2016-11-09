<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class withdrawal extends Model
{
    protected $fillable = [
    'id', 'name', 'client_id', 'destination_bank'
    ];

    /**
* The attributes that should be hidden for arrays.
*
* @var array
*/
    protected $hidden = [
    'api_token', 'client_id'
    ];

    public function App()
    {
        return $this->belongsTo('App\Apps', 'client_id', 'client_id');
    }
}
