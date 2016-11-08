@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">

      <div class="col-xs-12">
        <div class="alertas">

        </div>
        @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif
      </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                roles permissions
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-xs-12">

                  </div>
                  <div class="col-md-4 col-xs-12">
                    role name: {{$role->name}}
                  </div>
                  <div class="col-md-4 col-xs-12">
                    role slug: {{$role->slug}}
                  </div>
                  <div class="col-md-4 col-xs-12">
                    <a href="/roles/edit/{{$role->id}}" class="btn btn-info">edit role</a>
                  </div>
                  <div class="col-xs-12">
                    role description: {{$role->description}}
                  </div>
                  <div style="margin-top:50px" class="col-xs-12">
                    <form  role="form" id="assign">
                      <input type="hidden" id="url" name="url" value="assignpermission">
                      <input type="hidden" id="id" name="id" value="{{$role->id}}">
                      <div class="row">
                        <div class="form-group col-md-8 col-md-offset-2">
                          <label for="">assign permission</label>
                          <select class="form-control" name="idPermission[]" multiple required>
                            @foreach($permissionsList as $perm)
                              <option value="{{$perm->id}}"> {{$perm->slug}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-md-8 col-md-offset-2">
                            {!! csrf_field() !!}
                          <input type="submit" name="submit" value="asign permission" class="btn btn-success">

                          <a href="#" data-id="{{$role->id}}"  data-url="revoleallpermissions" class="btn btn-danger revokeAll" >revoke all permissions</a>
                        </div>
                      </div>


                    </form>
                  </div>
                  <div style="margin-top:50px" class="col-xs-12">
                    <table class="table table-striped" >
                      <thead>
                        <tr>
                          <th>
                            Name
                          </th>
                          <th>
                            Slug
                          </th>
                          <th>
                            action
                          </th>
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
                            <td>
                                <a href="#"  data-idElement="{{$role->id}}" data-idtoRevoke="{{$permission->id}}" data-url="revokePermissions" class="btn btn-danger revoke" >revoke permission</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
