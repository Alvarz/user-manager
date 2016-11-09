@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Deposits list
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-xs-12" style="text-align:right;">
                    <div class="row">
                      <div class="col-sm-6">
                        <form role="form" method="POST" action="/withdrawals">
                          <div class="form-group">
                            <select onchange="this.form.submit()" class="form-control" name="filter" id="filter">
                              <option>Filter by website</option>
                              @foreach($apps as $app)
                                <option @if($filter == $app->client_id) selected @endif value="{{$app->client_id}}" >{{$app->name}}</option>
                              @endforeach
                            </select>
                          </div>
                          {!! csrf_field() !!}
                        </form>
                      </div>
                      <div class="col-xs-6">
                        <a href="/withdrawals" class="btn btn-sm btn-default" >All</a>
                        <a href="/withdrawals/approved" class="btn btn-sm btn-success" >approved</a>
                        <a href="/withdrawals/rejected" class="btn btn-sm btn-danger" >rejected</a>
                        <a href="/withdrawals/waiting" class="btn btn-sm btn-warning" >approved</a>
                      </div>
                    </div>
                  </div>
                </div>
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Website
                      </th>
                      <th>
                        Name
                      </th>
                      <th>
                        destination bank
                      </th>
                      <th>
                        amount
                      </th>
                      <th>
                        account number
                      </th>
                      <th>
                        status
                      </th>
                      <th>
                        date
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($withdrawals as $withdrawal)
                      <tr style="cursor:pointer" onclick="window.location='/withdrawals/details/{{$withdrawal->id}}'">
                        <td>
                          {{$withdrawal->appName}}
                        </td>
                        <td>
                          {{$withdrawal->name}}
                        </td>
                        <td>
                          {{$withdrawal->destination_bank}}
                        </td>
                        <td>
                            {{$withdrawal->amount}}
                        </td>
                        <td>
                            {{$withdrawal->account_number}}
                        </td>
                        <td>
                          @if($withdrawal->status == 'approved')
                          <div class="label label-success">
                            {{$withdrawal->status}}
                          </div>
                          @elseif($withdrawal->status == 'rejected')
                          <div class="label label-danger">
                            {{$withdrawal->status}}
                          </div>
                          @else
                          <div class="label label-warning">
                            {{$withdrawal->status}}
                          </div>
                          @endif
                          </td>
                        <td>
                            {{$withdrawal->updated_at}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div style="text-align:center" class="panel-footer">

                {{ $withdrawals->links() }}
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
