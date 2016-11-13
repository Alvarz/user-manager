@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                <div class="row">
                  <div class="col-md-3 col-sm-6 col-xs-12">
                      <a class="btn btn-primary btn-lg" href="/endpoints">Api Endpoints</a>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                      <a class="btn btn-warning btn-lg" href="/properties">Properties list</a>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                      <a class="btn btn-success btn-lg" href="/property/create">Add property</a>
                  </div>
                  <div class="col-md-3  col-sm-6 col-xs-12">
                      <a class="btn btn-info btn-lg" href="/users">Users List</a>
                  </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
