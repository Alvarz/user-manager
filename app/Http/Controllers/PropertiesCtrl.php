<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\State;
use App\Http\Requests;
use App\HelperFunctions;

class PropertiesCtrl extends Controller
{
  private $helper;
  public function __construct()
  {
    $this->middleware('auth');
    $this->helper = new HelperFunctions;
  }

  public function index()
  {
      $data['properties'] = Property::paginate(10);

      // dd($data['properties'][0]->state->name);
      return view('modules/properties/properties')->with($data);
  }

  public function details($idProperty)
  {
      $data['states'] = State::all();
      $data['property'] = Property::find($idProperty);
      return view('modules/properties/property-details')->with($data);
  }

  public function updateState($idProperty, $state)
  {
      $request = new Request();
      $data['property'] = Property::find($idProperty);

      foreach ($data['property']['attributes'] as $key => $value) {
        if ($key == 'state_id') {
          $request->$key = $state;
        }else{
          $request->$key = $value;
        }
      }

      return $this->update($idProperty, $request);
  }

  public function update($idProperty, Request $request)
  {
    //   $this->validate($request, [
    //     'title' => 'required|max:255',
    //     'description' => 'max:500',
    //     'address' => 'required|max:255',
    //     'town' => 'required|max:255',
    //     'county' => 'required|max:255',
    //     'country' => 'required|max:255',
    //     'state_id' => 'required'
    // ]);

    $property = Property::find($idProperty);

    $property->title = $request->title;
    $property->description = $request->description;
    $property->address = $request->address;
    $property->town = $request->town;
    $property->county = $request->county;
    $property->country = $request->country;
    $property->state_id = $request->state_id;

    if ($property->save()) {
      return $this->helper->responseJson('property updated');
    }else{
      return $this->helper->responseJson('error updateding poperty', false);
    }
  }

}
