@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-md-8 col-md-offset-2 col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Apps list
              </div>
              <div class="panel-body">
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        client id
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        api_token
                      </th>
                      <th>
                        url
                      </th>
                      @canatleast(['app.edit', 'app.delete'])
                      <th>
                        action
                      </th>
                        @endcanatleast
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($apps as $app)
                      <tr>
                        <td>
                          {{$app->client_id}}
                        </td>
                        <td>
                          {{$app->name}}
                        </td>
                        <td>
                          {{$app->api_token}}
                        </td>
                        <td>
                          {{$app->url}}
                        </td>
                        @canatleast(['app.edit', 'app.delete'])
                          <td>
                            @can('app.edit')
                              <a href="/apps/edit/{{$app->id}}" class="btn btn-info" >edit</a>
                            @endcan
                            @can('app.delete')
                              <a href="#"  data-id="{{$app->id}}" data-url="apps" class="btn btn-danger delete" >delete</a>
                            @endcan
                          </td>
                          @endcanatleast
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div class="panel-footer">
                @can('app.add')
                <a href="/apps/create" class="btn btn-info">Add new app</a>
                @endcan
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
