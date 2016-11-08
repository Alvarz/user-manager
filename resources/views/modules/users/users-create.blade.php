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
                roles creator
              </div>
              <div class="panel-body">
                <form role="form" id="creator" >
                  <input type="hidden" name="url" id="url" value="users">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" class="form-control" name="name" required value="">
                    </div>
                    <div class="form-group">
                      <label for="">email</label>
                      <input type="email" class="form-control" name="email" required value="">
                    </div>
                    <div class="form-group">
                      <label for="">password</label>
                      <input id="password" type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group">
                      <label for="">repeat password</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="">
                    </div>
                    <div class="form-group">
                      <label for="">roles</label>
                      <select class="form-control" name="role" >
                        @foreach($roles as $role)
                          <option  @if($role->slug == 'default') selected @endif value="{{$role->id}}">{{$role->slug}}</option>
                        @endforeach
                      </select>
                    </div>
                    {!! csrf_field() !!}
                    <input type="submit" name="submit" class="btn btn-default" value="create user">
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
