<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use App\HelperFunctions;

class Players
{
    public $helper;
    public $jsonHelper;

    public function __construct()
    {
        $this->helper     = new HelperFunctions(false, true);
        $this->jsonHelper = new HelperFunctions();

    }

    public function GetPlayerData($idPlayer)
    {
        return $this->jsonHelper->Get("dgsapi.php?db&sp=WebGetPlayerOnline&p1=".$idPlayer, true);
    }

    public function GetPlayerBalance($idPlayer, $IdCurrency = 1)
    {
        return  $this->helper->Get("player/GetPlayerBalance/".$idPlayer."/".$IdCurrency, false);
    }
}
