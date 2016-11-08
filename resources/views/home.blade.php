@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                <div class="row">
                  <div style="text-align:center" class="col-sm-6 col-xs-12">
                    <a class="btn btn-warning btn-lg" href="{{ url('/deposits/waiting') }}">
                        @inject('deposit', 'App\Http\Controllers\DepositsCtrl')
                      Deposits waiting
                      @if($deposit->GetWaitingDepositsCount() > 0)
                        <span class="badge badge-info">{{$deposit->GetWaitingDepositsCount()}}</span>
                      @endif
                    </a>
                  </div>
                  <div style="text-align:center" class="col-sm-6 col-xs-12">
                    <a class="btn btn-info btn-lg" href="{{ url('/withdrawals/waiting') }}">
                      @inject('Withdrawal', 'App\Http\Controllers\WithdrawalCtrl')
                      Withdrawals waiting
                      @if($Withdrawal->GetWaitingWithdrawalsCount() > 0)
                        <span class="badge badge-warning">{{$Withdrawal->GetWaitingWithdrawalsCount()}}</span>
                      @endif
                    </a>
                  </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
