@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Roles list
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
                      @canatleast(['role.edit', 'role.delete', 'permission.assign'])
                      <th>
                        action
                      </th>
                        @endcanatleast
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($roles as $role)
                      <tr>
                        <td>
                          {{$role->name}}
                        </td>
                        <td>
                          {{$role->slug}}
                        </td>
                        @canatleast(['role.edit', 'role.delete', 'permission.assign'])
                          <td>
                            @can('role.edit')
                              <a href="/roles/edit/{{$role->id}}" class="btn btn-info" >edit</a>
                            @endcan
                            @can('role.delete')
                            <a href="#"  data-id="{{$role->id}}" data-url="roles" class="btn btn-danger delete" >delete</a>
                            @endcan
                            @can('permission.assign')
                            <a href="/roles/permissions/{{$role->id}}"  class="btn btn-warning" >permissions</a>
                            @endcan
                          </td>
                        @endcanatleast
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="panel-footer">
                @can('role.add')
                  <a href="/roles/create" class="btn btn-info">Add new role</a>
                @endcan
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
