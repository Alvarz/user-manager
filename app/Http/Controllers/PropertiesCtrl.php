<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\State;
use App\Http\Requests;
use App\Http\Controllers\CrudCtrlProperties;;
use App\HelperFunctions;
use App\Properties_facilities;
use App\Facilities;

class PropertiesCtrl extends Controller
{

  private $herlper;
  private $CrudCtrl;

  /**
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->helper = new HelperFunctions;
    $this->CrudCtrl = new CrudCtrlProperties();
  }

  /**
   *
   * @return Illuminate\View
   */
  public function index()
  {

      $data['properties'] = Property::orderBy('updated_at', 'desc')->paginate(10);
      return view('modules/properties/properties')->with($data);
  }

  /**
   *
   * @return Illuminate\View
   */
  public function create()  {

        $data['facilities'] = Facilities::all();
        return view('modules/properties/property-create')->with($data);
    }

    /**
     * @param int
     * @return Illuminate\View
     */
  public function details($idProperty)
  {
      $data['states'] = State::all();
      $data['property'] = Property::find($idProperty);
      return view('modules/properties/property-details')->with($data);
  }

  /**
   * @param int
   * @return Illuminate\View
   */
  public function edit($idProperty)
  {
      $data['states'] = State::all();
      $data['facilities'] = Facilities::all();
      $data['property'] = Property::find($idProperty);
      return view('modules/properties/property-edit')->with($data);
  }


  /**
   * @param int, string
   * @return array
   */
  public function updateState($idProperty, $state)
  {
      $request = new Request();
      $data['property'] = Property::find($idProperty);

      foreach ($data['property']['attributes'] as $key => $value) {
        if ($key == 'state_id') {
          $request[$key] = $state;
        }else{
          $request[$key] = $value;
        }
      }

      return $this->CrudCtrl->update($idProperty, $request);
  }




}
