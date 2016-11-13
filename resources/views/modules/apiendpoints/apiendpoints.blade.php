@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Api Endpoints
              </div>
              <div class="panel-body">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Action
                      </th>
                      <th>
                        Endpoint
                      </th>
                      <th>
                        Method
                      </th>
                      <th>
                        body
                      </th>
                      <th>
                        Response
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>
                          Get All properties
                        </td>
                        <td>
                            <code>/api/properties</code>
                        </td>
                        <td>
                            GET
                        </td>
                        <td>

                        </td>
                        <td>
                          <code>
                            [
                              {
                                "id": 1,
                                "title": "Apt. 400",
                                "description": "Iste cum architecto adipisci sed et rem. Ut et sapiente quis commodi ipsa. Alias nisi sit ut quos iusto.",
                                "address": "5187 Dorcas Harbors Suite 131\nWillmschester, ID 89786-0106",
                                "town": "Lake Noemiton",
                                "county": "Nicaragua",
                                "country": "Costa Rica",
                                "state_id": 1,
                                "state": {
                                  "name": "En revisión"
                                },
                                "facilities": [
                                  {
                                    "name": "Edificio con ascensor"
                                  },
                                  {
                                    "name": "Piscina"
                                  },
                                  {
                                    "name": "Estacionamiento"
                                  },
                                  {
                                    "name": "Cocina"
                                  },
                                  {
                                    "name": "Aire acondicionado"
                                  }
                                ]
                              },
                              ....
                            ]
                          </code>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Get certain property
                        </td>
                        <td>
                            <code>/api/properties/IDproperty</code>
                        </td>
                        <td>
                            GET
                        </td>
                        <td>

                        </td>
                        <td>
                          <code>
                            [
                              {
                                "id": 1,
                                "title": "Apt. 400",
                                "description": "Iste cum architecto adipisci sed et rem. Ut et sapiente quis commodi ipsa. Alias nisi sit ut quos iusto.",
                                "address": "5187 Dorcas Harbors Suite 131\nWillmschester, ID 89786-0106",
                                "town": "Lake Noemiton",
                                "county": "Nicaragua",
                                "country": "Costa Rica",
                                "state_id": 1,
                                "state": {
                                  "name": "En revisión"
                                },
                                "facilities": [
                                  {
                                    "name": "Edificio con ascensor"
                                  },
                                  {
                                    "name": "Piscina"
                                  },
                                  {
                                    "name": "Estacionamiento"
                                  },
                                  {
                                    "name": "Cocina"
                                  },
                                  {
                                    "name": "Aire acondicionado"
                                  }
                                ]
                              }
                            ]
                          </code>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Post a property
                        </td>
                        <td>
                            <code>/api/properties</code>
                        </td>
                        <td>
                            POST
                        </td>
                        <td>
                          <code>
                            {
                              "title": "Apt. 4000000",
                        	    "description": "Iste cum architecto adipisci sed et rem. Ut et sapiente quis commodi ipsa. Alias nisi sit ut quos iusto.",
                        	    "address": "5187 Dorcas Harbors Suite 131\nWillmschester, ID 89786-0106",
                        	    "town": "Lake Noemiton",
                        	    "county": "Nicaragua",
                        	    "country": "Costa Rica",
                              "facilities": [1,2,3,4]
                           }
                          </code>
                        </td>
                        <td>
                          <code>
                            {
                              "status": true,
                              "type": "alert-success",
                              "msg": "property created"
                            }
                          </code>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Update a property
                        </td>
                        <td>
                            <code>'/api/properties/idProperty'</code>
                        </td>
                        <td>
                            PUT
                        </td>
                        <td>
                          <code>
                            {
                              "title": "Apt. 4000000",
                        	    "description": "Iste cum architecto adipisci sed et rem. Ut et sapiente quis commodi ipsa. Alias nisi sit ut quos iusto.",
                        	    "address": "5187 Dorcas Harbors Suite 131\nWillmschester, ID 89786-0106",
                        	    "town": "Lake Noemiton",
                        	    "county": "Nicaragua",
                        	    "country": "Costa Rica",
                        	    "state_id": 3,
                              "facilities": [1,2,3,4]
                           }
                          </code>
                        </td>
                        <td>
                          <code>
                            {
                              "status": true,
                              "type": "alert-success",
                              "msg": "property updated"
                            }
                          </code>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          Delete a property
                        </td>
                        <td>
                            <code>/api/properties/idProperty</code>
                        </td>
                        <td>
                            DELETE
                        </td>
                        <td>
                        </td>
                        <td>
                          <code>
                            {
                              "status": true,
                              "type": "alert-success",
                              "msg": "property deleted"
                            }
                          </code>
                        </td>
                      </tr>
                  </tbody>
                </table>

              </div>
            </div>
        </div>
    </div>
</div>
@endsection
