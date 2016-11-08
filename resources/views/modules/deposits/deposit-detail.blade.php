@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2 alertas col-xs-12">

      </div>
        <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                Deposits details
              </div>
              <div class="panel-body">
                  <h3>Deposit data</h3>
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
                      bank
                    </th>
                    <th>
                      amount
                    </th>
                    <th>
                      type
                    </th>
                    <th>
                      voucher
                    </th>
                    <th>
                      origin bank
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
                      {{$deposit->name}}
                    </td>
                      <td>
                      {{$deposit->email}}
                      </td>
                    <td>
                      {{$deposit->bank}}
                      </td>
                    <td>
                      {{$deposit->amount}}
                      </td>
                    <td>
                      {{$deposit->transaction_type}}
                    </td>
                    <td>
                      {{$deposit->voucher_number}}
                    </td>
                      <td>
                      {{$deposit->origin_bank}}
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
                      {{$deposit->created_at}}
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
                  <div class="col-sm-6 col-xs-12">
                    <p>
                      <strong>voucher image</strong>
                    </p>
                      <img src="{{$deposit->voucher_img}}" alt="voucher_img" />
                  </div>

                  @if($deposit->status == 'waiting review')

                    @can('deposits.edit')
                      <div class="col-sm-6 col-xs-12">
                        <a href="#"  data-url="deposits" data-id="{{$deposit->id}}" data-idplayer="{{$deposit->IdPlayer}}" data-status="approved" class="btn btn-lg btn-success statusBtn" >Approve</a>
                        <a href="#"  data-url="deposits"  data-id="{{$deposit->id}}" data-idplayer="{{$deposit->IdPlayer}}" data-status="rejected" class="btn btn-lg btn-danger statusBtn">Reject</a>
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
                            {{$deposit->updated_at}}
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
