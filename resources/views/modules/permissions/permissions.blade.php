@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Permissions list
              </div>
              <div class="panel-body">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Name
                      </th>
                      <th>
                        Slug
                      </th>
                      @canatleast(['permission.edit', 'permission.delete'])
                      <th>
                        action
                      </th>
                        @endcanatleast
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($permissions as $permission)
                      <tr>
                        <td>
                          {{$permission->name}}
                        </td>
                        <td>
                          {{$permission->slug}}
                        </td>
                        @canatleast(['permission.edit', 'permission.delete'])
                          <td>
                            @can('permission.edit')
                              <a href="/permissions/edit/{{$permission->id}}" class="btn btn-info" >edit</a>
                            @endcan
                            @can('permission.delete')
                              <a href="#"  data-id="{{$permission->id}}" data-url="permissions" class="btn btn-danger delete" >delete</a>
                            @endcan
                          </td>
                          @endcanatleast
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="panel-footer">
                @can('permission.add')
                <a href="/permissions/create" class="btn btn-info">Add new permission</a>
                @endcan
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
