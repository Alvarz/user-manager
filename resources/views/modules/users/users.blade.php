@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                users list
              </div>
              <div class="panel-body">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Name
                      </th>
                      <th>
                        email
                      </th>
                      <th>
                        roles
                      </th>
                      @canatleast(['user.edit', 'user.delete'])
                      <th>
                        action
                      </th>
                      @endcanatleast
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                      <tr>
                        <td>
                          {{$user->name}}
                        </td>
                        <td>
                          {{$user->email}}
                        </td>
                        <td>
                          @foreach($user->roles as $role)
                            {{$role}},
                          @endforeach
                        </td>
                          @canatleast(['user.edit', 'user.delete'])
                          <td>
                            @can('user.edit')
                              <a href="/users/edit/{{$user->id}}" class="btn btn-info" >edit</a>
                            @endcan
                            @can('user.delete')
                              <a href="#"  data-id="{{$user->id}}" data-url="users" class="btn btn-danger delete" >delete</a>
                            @endcan
                          </td>
                          @endcanatleast
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="panel-footer">
                @can('user.add')
                  <a href="/users/create" class="btn btn-info">Add new user</a>
                @endcan
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
