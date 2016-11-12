<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertiesCtrl extends Model
{
    public function __construct()
    {
      $this->middleware('auth');
    }
}
