@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                withdrawals details
              </div>
              <div class="panel-body">
                  <h3>withdrawal data</h3>
                <table class="table table-striped" >
                  <thead>
                    <tr>
                      <th>
                        Player
                      </th>
                    <th>
                      name
                    </th>
                    <th>
                      email
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
                    <tr>
                      <td>
                      {{$playerInfo->Player}}
                      </td>
                    <td>
                      {{$withdrawal->name}}
                    </td>
                      <td>
                      {{$withdrawal->email}}
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
                      {{$withdrawal->created_at}}
                    </td>
                    </tr>
                  </tbody>
                </table>
                  <h3>Player info</h3>
                <table class="table table-striped" >
                  <thead>
                    <tr>
                    <th>
                      Player
                    </th>
                    <th>
                      Balance
                    </th>
                    <th>
                      Risk
                    </th>
                    <th>
                      Credit Limit
                    </th>
                    <th>
                      Free Play
                    </th>
                    <th>
                      Points
                    </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                    <td>
                      {{$playerInfo->Player}}
                    </td>
                      <td>
                    {{$PlayerBalance['RealAvailBalance']}}
                      </td>
                    <td>
                      {{$PlayerBalance['AmountAtRisk']}}
                      </td>
                    <td>
                    {{$PlayerBalance['CreditLimit']}}
                      </td>
                    <td>
                    {{$PlayerBalance['FreePlayAmount']}}
                    </td>
                    <td>
                    {{$PlayerBalance['BonusPoints']}}
                    </td>
                    </tr>
                  </tbody>
                </table>
                <div class="row">
                  @if($withdrawal->status == 'waiting review')

                    @can('withdrawals.edit')
                      <div style="text-align:center" class="col-sm-6 col-sm-offset-3 col-xs-12">
                        <a href="#" data-url="withdrawals" data-id="{{$withdrawal->id}}" data-idplayer="{{$withdrawal->IdPlayer}}" data-status="approved" class="btn btn-lg btn-success statusBtn" >Approve</a>
                        <a href="#" data-url="withdrawals" data-id="{{$withdrawal->id}}" data-idplayer="{{$withdrawal->IdPlayer}}" data-status="rejected" class="btn btn-lg btn-danger statusBtn">Reject</a>
                        <div style="margin-top:20px" class="form-group">
                          <label for="">Payment method</label>
                          <select class="form-control" name="PayMethod" id="PayMethod" required>
                            @foreach($paymentMethod as $method)
                              <option value="{{$method->IdPaymentMethod}}" >{{$method->PaymentMethodName}}</option>
                            @endforeach
                          </select>
                        </div>

                      </div>
                    @endcan

                  @else
                  <div class="col-sm-6 col-xs-12">
                      <h3>Review info</h3>
                    <table class="table table-striped table-border">
                      <thead>
                        <tr>
                          <th>
                            Reviewed by
                          </th>
                          <th>
                            date
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            {{$user->name}}
                          </td>
                          <td>
                            {{$withdrawal->updated_at}}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
