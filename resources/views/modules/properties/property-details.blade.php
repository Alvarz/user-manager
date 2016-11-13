@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                      Property
                  </div>
                  <div class="col-xs-6" >
                      <a style="float:right" href="/property/edit/{{$property->id}}" class="btn btn-lg btn-info">Edit</a>
                  </div>
                </div>

              </div>
              <div class="panel-body">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Title
                      </th>
                      <th>
                        town
                      </th>
                      <th>
                        country
                      </th>
                      <th>
                        address
                      </th>
                      <th>
                        State
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                      <tr>
                        <td>
                          {{$property->title}}
                        </td>
                        <td>
                            {{$property->town}}
                        </td>
                        <td>
                            {{$property->country}}
                        </td>
                        <td>
                          {{$property->address}}
                        </td>
                        <td>
                          <form role="form">
                            <select id="states" data-url="property/updateState" data-id="{{$property->id}}" class="form-control" name="state">
                              @foreach($states as $state)
                                <option @if($property->state->id == $state->id) selected @endif value="{{$state->id}}">{{$state->name}}</option>
                              @endforeach
                            </select>
                          </form>
                        </td>
                      </tr>
                  </tbody>
                </table>
                <label for="">Description</label>
                <div class="">
                    {{$property->description}}
                </div>
                <div class="">
                  <ul class="list-group">
                    @foreach($property->facilities as $facilityObj)
                      <li class="list-group-item">{{$facilityObj->facility[0]->name}}</li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
