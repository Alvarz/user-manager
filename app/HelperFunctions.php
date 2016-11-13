<?php


namespace App;

use Illuminate\Database\Eloquent\Model;


class HelperFunctions extends Model
{

  /**
   * @param string, bool
   * @return array
   */
  public function responseJson($msg, $status=true)
  {
    $type = ($status) ? 'alert-success' : 'alert-error';
    return array(
      'status' => $status,
      'type' => $type,
      'msg' => $msg
    );
  }

}
