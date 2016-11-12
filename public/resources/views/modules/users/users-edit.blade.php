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
                user editor
              </div>
              <div class="panel-body">
                <form role="form" id="update" >
                  <input type="hidden" id="id" name="id" value="{{$user->id}}">
                    <input type="hidden" id="url" name="url" value="users">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                      <label for="">email</label>
                      <input type="text" class="form-control" name="email" required value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                      <label for="">password</label>
                      <input id="password" type="password" class="form-control" name="password"  value="">
                    </div>
                    <div class="form-group">
                      <label for="">repeat password</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="">
                    </div>
                    <div class="form-group">
                      <label for="">roles</label>
                      <select class="form-control" name="idRole[]" multiple >
                        @foreach($roles as $role)
                          @foreach($user->roles as $userRole)
                            <option  @if($role->slug == $userRole) selected @endif value="{{$role->id}}">{{$role->slug}}</option>
                          @endforeach
                        @endforeach
                      </select>
                    </div>
                    {!! csrf_field() !!}
                    <input type="submit" name="submit" class="btn btn-default" value="update user">
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
