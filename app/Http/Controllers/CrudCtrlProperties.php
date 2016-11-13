<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\State;
use App\HelperFunctions;
use App\Properties_facilities;
use App\Facilities;
use App\Http\Requests;

class CrudCtrlProperties extends Controller
{
  private $herlper;

  /**
   *
   * @return void
   */
  public function __construct()
  {
    $this->helper = new HelperFunctions;
  }

  /**
   *
   * @return array
   */
    public function getProperties()
    {
      $properties = Property::all();

      foreach ($properties as $key => $Property) {

        $Property->state = $Property->state;
        $Property->facilities = $Property->facilities;
        foreach ($Property->facilities as $key => $facilityObj) {
          $Property->facilities[$key] = $facilityObj->facility[0];
        }
      }

      $properties[$key] = $Property;
      return $properties;
    }

    /**
     * @param int
     * @return array
     */
    public function getOneProperty($idProperty)
    {
      $Property = Property::find($idProperty);

      $Property->state = $Property->state;
      $Property->facilities = $Property->facilities;
      foreach ($Property->facilities as $key => $facilityObj) {
        $Property->facilities[$key] = $facilityObj->facility[0];
      }
      return $Property;

    }

    /**
     * @param int, request
     * @return aray
     */
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


    /**
     * @param request
     * @return array
     */
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

    /**
     * @param int
     * @return array
     */
    public function delete($idProperty)
    {
      $property = Property::find($idProperty);

      if ($property->delete()) {
        return $this->helper->responseJson('property deleted');
      }else{
        return $this->helper->responseJson('error deleting poperty', false);
      }

    }


    /**
     * @param array
     * @return array
     */
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
