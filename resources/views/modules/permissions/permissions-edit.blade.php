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
                Permissions editor
              </div>
              <div class="panel-body">
                <form role="form" id="update" >
                  <input type="hidden" id="id" name="id" value="{{$permission->id}}">
                    <input type="hidden" id="url" name="url" value="permissions">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$permission->name}}">
                    </div>
                    <div class="form-group">
                      <label for="">slug</label>
                      <input type="text" class="form-control" name="slug" required value="{{$permission->slug}}">
                    </div>
                    <div class="form-group">
                      <label for="">description</label>
                      <textarea name="description" class="form-control" rows="8" cols="40">{{$permission->description}}</textarea>
                    </div>
                    {!! csrf_field() !!}
                    <input type="submit" name="submit" class="btn btn-default" value="update permissions">
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
