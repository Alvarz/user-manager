<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\State;
use App\Http\Requests;
use App\HelperFunctions;
use App\Properties_facilities;
use App\Facilities;

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
      return view('modules/properties/properties')->with($data);
  }

  public function create()  {

        $data['facilities'] = Facilities::all();
        return view('modules/properties/property-create')->with($data);
    }

  public function details($idProperty)
  {
      $data['states'] = State::all();
      $data['property'] = Property::find($idProperty);
      return view('modules/properties/property-details')->with($data);
  }

  public function edit($idProperty)
  {
      $data['states'] = State::all();
      $data['facilities'] = Facilities::all();
      $data['property'] = Property::find($idProperty);
      return view('modules/properties/property-edit')->with($data);
  }

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

      return $this->update($idProperty, $request);
  }


/*********************************/
  /****************CRUD*************/
/*********************************/

  public function getProperties()
  {
    return Property::all();
  }

  public function getOneProperty($idProperty)
  {
    return Property::find($idProperty);
  }

  public function update($idProperty, Request $request)
  {
      $this->validate($request, [
        'title' => 'required|max:255',
        'description' => 'max:500',
        'address' => 'required|max:255',
        'town' => 'required|max:255',
        'county' => 'required|max:255',
        'country' => 'required|max:255',
        'state_id' => 'required'
    ]);

    $property = Property::find($idProperty);

    $property->title = $request->input('title');
    $property->description = $request->input('description');
    $property->address = $request->input('address');
    $property->town = $request->input('town');
    $property->county = $request->input('county');
    $property->country =  $request->input('country');
    $property->state_id =  $request->input('state_id');

    if ($property->save()) {

      if (isset($request['facilities'])) {
        $deletedRows = Properties_facilities::where('property_id', $idProperty)->delete();
        return $this->storeFacilities($request['facilities'], $property);
        
      }else{
        return $this->helper->responseJson('state updated');
      }


    }else{
      return $this->helper->responseJson('error updateding poperty', false);
    }
  }


  public function store(Request $request)
  {
      $this->validate($request, [
        'title' => 'required|max:255',
        'description' => 'max:500',
        'address' => 'required|max:255',
        'town' => 'required|max:255',
        'county' => 'required|max:255',
        'country' => 'required|max:255'
    ]);

    // dd($request->all());
    $res =  Property::create([
      'title' => $request->input('title'),
      'description' => $request->input('description'),
      'address' => $request->input('address'),
      'town' => $request->input('town'),
      'county' => $request->input('county'),
      'country' => $request->input('country'),
      'state_id' => 1
    ]);

    if ($res) {
        return $this->storeFacilities($request['facilities'], $res);
    }else{
      return $this->helper->responseJson('error updateding poperty', false);
    }
  }

  public function delete($idProperty)
  {
    $property = Property::find($idProperty);

    if ($property->delete()) {
      return $this->helper->responseJson('property deleted');
    }else{
      return $this->helper->responseJson('error deleting poperty', false);
    }

  }


  private function storeFacilities($facilities, $property)
  {
    foreach ($facilities as $Idfacility) {

      $res = Properties_facilities::create([
        'property_id' => $property->id,
        'facility_id' => $Idfacility
      ]);
    }

    if ($res) {
      return $this->helper->responseJson('property created');
    }else{
      return $this->helper->responseJson('error creating poperty', false);
    }

  }

}
