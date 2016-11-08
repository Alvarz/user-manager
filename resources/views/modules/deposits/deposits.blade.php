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
                    <a href="/deposits" class="btn btn-sm btn-default" >All</a>
                    <a href="/deposits/approved" class="btn btn-sm btn-success" >approved</a>
                    <a href="/deposits/rejected" class="btn btn-sm btn-danger" >rejected</a>
                    <a href="/deposits/waiting" class="btn btn-sm btn-warning" >approved</a>
                  </div>
                </div>
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Name
                      </th>
                      <th>
                        bank
                      </th>
                      <th>
                        amount
                      </th>
                      <th>
                        vouncher number
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
                    @foreach($deposits as $deposit)
                      <tr style="cursor:pointer" onclick="window.location='/deposits/details/{{$deposit->id}}'">
                        <td>
                          {{$deposit->name}}
                        </td>
                        <td>
                          {{$deposit->bank}}
                        </td>
                        <td>
                            {{$deposit->amount}}
                        </td>
                        <td>
                            {{$deposit->voucher_number}}
                        </td>
                        <td>
                          @if($deposit->status == 'approved')
                          <div class="label label-success">
                            {{$deposit->status}}
                          </div>
                          @elseif($deposit->status == 'rejected')
                          <div class="label label-danger">
                            {{$deposit->status}}
                          </div>
                          @else
                          <div class="label label-warning">
                            {{$deposit->status}}
                          </div>
                          @endif
                          </td>
                        <td>
                            {{$deposit->updated_at}}
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <div style="text-align:center" class="panel-footer">

                {{ $deposits->links() }}
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
