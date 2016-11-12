<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Deposits;
use App\withdrawal;


class HelperFunctions extends Model
{
    private  $client;
    private $ProxyDomain = ""; //public
    private $ProxyDomain2 = ""; //public

    /**
 * constructor method
 *
 *  @param  jsJson bool
 *  @param  din bool
 *  @return void
 */
    public function __construct($isJson = true, $dom = false)
    {
        $accept = (!$isJson) ? "text/xml" : 'application/json';
        $dom = (!$dom) ? $this->ProxyDomain : $this->ProxyDomain2;

        $this->client = new Client(
            ['base_uri' => $dom,
            'headers' => [
            'Accept' => $accept,
            'Content-Type' => $accept
            ],
            ]
        );
    }

    /**
   * POST or PUT calls to api/rest
   *
   *  @param  entrypoint string
   *  @param  jsJson bool
   *  @param  method string
   *  @return string or json
   */
    public function Get($query, $isJson=false, $method="GET")
    {

        $res = $this->client->request($method, $query);
        $data = $res->getBody();

        if ($isJson) { return json_decode($data->getContents());
        }

        return $this->GetxmlVars($data->getContents());


    }

    /**
   * POST or PUT calls to api/rest
   *
   *  @param  entrypoint string
   *  @param  arrayData array
   *  @param  jsJson bool
   *  @param  method string
   *  @return stiring or json
   */
    public function Post_Put($entryPoint, $arrayData, $isJson=false, $method = 'POST')
    {
        $request = new Request($method, $entryPoint);
        $res = $client->send($request, $arrayData);
        $data = $res->getBody();

        if ($isJson) { return json_decode($data->getContents());
        }

        return $this->GetxmlVars($data->getContents());

    }


  public function responseJson($msg, $status=true)
  {
    $type = ($status) ? 'alert-success' : 'alert-error';
    return array(
      'status' => $status,
      'type' => $type,
      'msg' => $msg
    );
  }

    /**
   * Display a listing of the resource.
   *
   *  @param  method string
   *  @param  params string
   *  @param  url string
   *  @return stiring or json
   */

    public function mb_unserialize($string)
    {
        $string = preg_replace_callback(
            '/!s:(\d+):"(.*?)";!se/', function ($matches) {
                return 's:'.strlen($matches[1]).':"'.$matches[1].'";';
            }, $string
        );
        return unserialize($string);
    }

    private function GetxmlVars($xml)
    {

        //eliminamos el root string creado por microsoft y fixeamos los enttities xml
        $res = str_replace(array('<string xmlns="http://schemas.microsoft.com/2003/10/Serialization/">', '</string>'), "", $xml);
        $xmlNew = simplexml_load_string(html_entity_decode($res));

        // lo retornamos como json;
        $jsonString = json_encode($xmlNew);
        $array = json_decode($jsonString, true);
        /*print_r($array);*/
        /*echo $array["@attributes"]["IdAgent"];
        echo isset($array["@attributes"]["hola"]) ? "existe" : "no existe";*/
        //dd($array);
        return $array;

    }

    public function GetWeekDates($isLastWeek = false, $date=null )
    {
        $dateTime = ($isLastWeek) ? new \DateTime('7 days ago') : new \DateTime();

        // si date es diferente de nulo usamos la fecha proporcionada
        $dateTime = ($date != null) ? \DateTime::createFromFormat('m-d-Y', $date) : $dateTime;

        $monday = clone $dateTime->modify(('Sunday' == $dateTime->format('l')) ? 'Monday last week' : 'Monday this week');
        $sunday = clone $dateTime->modify('Sunday this week');
        //dd($monday);

        return array("start" => $monday->format('m-d-Y'), "End" => $sunday->format('m-d-Y'));

    }

    public function setFloat($number, $currency = 1)
    {
        $delimieter = ($currency == 2) ? ',' : '.';
        return number_format((float)$number, 2, $delimieter, '');

    }

    public function isValidDateTimeString($str_dt, $str_dateformat = 'Y-m-d H:i:s.u', $str_timezone = 'America/Caracas')
    {
        $date = \DateTime::createFromFormat($str_dateformat, $str_dt, new \DateTimeZone($str_timezone));
        return $date && \DateTime::getLastErrors()["warning_count"] == 0 && \DateTime::getLastErrors()["error_count"] == 0;
    }

    public function FormatDate($fecha)
    {
        if ($this->isValidDateTimeString($fecha)) {

            $date = new \DateTime($fecha);
            $fecha  = $date->format('m-d-Y H:i');
        }
        else if ($this->isValidDateTimeString($fecha, 'M-d H:i:s')) {

            $date = new \DateTime($fecha);
            $fecha  = $date->format('M-d H:i');
        }

        return $fecha;
    }

    public function setFloatValuesAndFormatDatesForObj($ObjDataOrArray)
    {
        foreach ($ObjDataOrArray as $key => $value) {

            if (is_object($ObjDataOrArray)) {
                $ObjDataOrArray->$key = $this->setFloatValuesAndFormatDates($value);
            }else{
                $ObjDataOrArray[$key] = $this->setFloatValuesAndFormatDates($value);
            }

        }
        return $ObjDataOrArray;
    }

    public function setFloatValuesAndFormatDates($ObjData)
    {
        foreach ($ObjData as $key => $value) {

            if (is_float($value + 0)) {

                if (is_object($ObjData)) {
                    $ObjData->$key  = $this->setFloat($value);
                }else{
                    $ObjData[$key]  = $this->setFloat($value);
                }

            }
            else if ($this->isValidDateTimeString($value)) {

                $date = new \DateTime($value);

                if (is_object($ObjData)) {
                    $ObjData->$key  = $date->format('m-d-Y H:i');
                }else{
                    $ObjData[$key]  = $date->format('m-d-Y H:i');
                }
            }

            else if ($this->isValidDateTimeString($value, 'M-d H:i:s')) {
                $date = new \DateTime($value);

                if (is_object($ObjData)) {
                    $ObjData->$key  = $date->format('M-d H:i');
                }else{
                    $ObjData[$key]  = $date->format('M-d H:i');
                }

            }
        }
        // dd($ObjData);
        return $ObjData;

    }

    public function searchWebsites($data, $isWithdrawal = false)
    {
        foreach ($data as $key => $value) {

            $data[$key]->appName = ($isWithdrawal) ? withdrawal::find($value->id)->App->name : Deposits::find($value->id)->App->name;

        }
        return $data;
    }


    public function Paginator($item_per_page, $paginationArray, $url, $type = "none")
    {

        $current_page  = $paginationArray["page_position"];
        $total_records = $paginationArray["totalRows"];
        $total_pages = $paginationArray["totalPages"];

        $pagination = '';
        if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages) { //verify total pages and current page number
            $pagination .= '<ul class="pagination">';

            $right_links    = $current_page + 3;
            $previous       = $current_page - 1; //previous link
            $next           = $current_page + 1; //next link
            $first_link     = true; //boolean var to decide our first link

            if($current_page > 1) {
                // $previous_link = ($previous==0)?1:$previous;
                $pagination .= '<li class="first"><a href="#" data-type="'.$type.'" data-url="'.$url.'" data-page="1" title="First">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="#"  data-type="'.$type.'" data-url="'.$url.'" data-page="'.$previous.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0) {
                        $pagination .= '<li><a href="#"  data-type="'.$type.'" data-url="'.$url.'" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if($first_link) { //if current active page is first link
                $pagination .= '<li class="first active"><a  data-type="'.$type.'" data-url="'.$url.'" href="#">'.$current_page.'</a></li>';
            }elseif($current_page == $total_pages) { //if it's the last active link
                $pagination .= '<li class="last active"><a  data-type="'.$type.'" data-url="'.$url.'" href="#">'.$current_page.'</a></li>';
            }else{ //regular current link
                $pagination .= '<li class="active"><a  data-type="'.$type.'" data-url="'.$url.'" href="#">'.$current_page.'</a></li>';
            }

            for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
                if($i<=$total_pages) {
                    $pagination .= '<li><a href="#"  data-type="'.$type.'" data-url="'.$url.'" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
                }
            }
            if($current_page < $total_pages) {
                  // $next_link = ($i > $total_pages)? $total_pages : $i;
                  $pagination .= '<li><a href="#"  data-type="'.$type.'" data-url="'.$url.'" data-page="'.$next.'" title="Next">&gt;</a></li>'; //next link
                  $pagination .= '<li class="last"><a  data-type="'.$type.'" data-url="'.$url.'" href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
            }

              $pagination .= '</ul>';
        }
        return $pagination; //return pagination links
    }


}
