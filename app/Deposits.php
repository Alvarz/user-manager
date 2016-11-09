<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deposits extends Model
{
    /*
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
     'id', 'name', 'client_id'
    ];

    /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
    protected $hidden = [
     'api_token'
    ];


    public $helper;
    public $jsonHelper;

    public function __construct()
    {
        $this->helper     = new HelperFunctions(false);
        $this->jsonHelper = new HelperFunctions();

    }

    public static function AddPlayerTransaction($data)
    {
        $jsonHelper = new HelperFunctions();
        $i = 1;
        $params = '';

        foreach ($data as $value) {

            $params .= '&p'.$i.'="'.$value.'"';
            $i++;
        }

        // dd("dgsapi.php?db&sp=WebInsertPlayerTransaction".$params);
        return $jsonHelper->Get("dgsapi.php?db&sp=WebInsertPlayerTransaction".$params, true);

    }


    public function GetPaymentMethods()
    {
        return $this->jsonHelper->Get("dgsapi.php?db&sp=PaymentMethod_GetList", true);
    }


    public function App()
    {
        return $this->belongsTo('App\Apps', 'client_id', 'client_id');
    }
}
