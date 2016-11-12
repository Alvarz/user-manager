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
                Apps editor
              </div>
              <div class="panel-body">
                <form role="form" id="update" >
                  <input type="hidden" id="id" name="id" value="{{$app->id}}">
                  <input type="hidden" id="url" name="url" value="apps">
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" class="form-control" name="name" required value="{{$app->name}}">
                    </div>
                    <div class="form-group">
                      <label for="">url</label>
                      <input type="text" class="form-control" name="url" required value="{{$app->url}}">
                    </div>
                    <div class="form-group">
                      <label for="">client id</label>
                      <p>
                        <strong>{{$app->client_id}}</strong>
                      </p>
                    </div>
                    <div class="form-group">
                      <label for="">api token</label>
                      <p>
                        <strong>{{$app->api_token}}</strong>
                      </p>
                    </div>
                    {!! csrf_field() !!}
                    <input type="submit" name="submit" class="btn btn-default" value="create app">
                </form>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
