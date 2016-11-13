@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Properties list
              </div>
              <div class="panel-body" >
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Title
                      </th>
                      <th>
                        address
                      </th>
                      <th>
                        State
                      </th>
                      <th>
                        Details
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($properties as $property)
                      <tr>
                        <td>
                          {{$property->title}}
                        </td>
                        <td>
                          {{$property->address}}
                        </td>
                        <td>
                          @if($property->state->name == 'En revisión')
                            <span class="label label-warning">{{$property->state->name}}</span>
                          @elseif($property->state->name == 'Activo')
                            <span class="label label-success">{{$property->state->name}}</span>
                          @else
                            <span class="label label-danger">{{$property->state->name}}</span>
                          @endif
                        </td>
                        <td>
                          <a class="btn btn-info btn-sm" href="/properties/{{$property->id}}">Details</a>
                          <a data-id="{{$property->id}}" class="btn btn-danger btn-sm del-property" href="#">Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="panel-footer">
                <div class="row">
                  <div style="text-align:center" class="col-sm-6 col-xs-12">
                      {{$properties->links()}}
                  </div>
                  <div style="text-align:center" class="col-sm-6 col-xs-12">
                    <a class="btn btn-success" href="/property/create">Add new property</a>
                  </div>
                </div>

              </div>
            </div>
        </div>
    </div>
</div>
@endsection
