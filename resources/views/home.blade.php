@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                <div class="row">
                  @can('deposits.edit.waiting')
                    <div style="text-align:center" class="col-sm-3 col-xs-12">
                      <a class="btn btn-warning " href="{{ url('/deposits/waiting') }}">
                          @inject('deposit', 'App\Http\Controllers\DepositsCtrl')
                        Deposits waiting
                        @if($deposit->GetWaitingDepositsCount() > 0)
                          <span class="badge">{{$deposit->GetWaitingDepositsCount()}}</span>
                        @endif
                      </a>
                    </div>
                  @endcan
                  @can('withdrawals.edit.waiting')
                    <div style="text-align:center" class="col-sm-3 col-xs-12">
                      <a class="btn btn-warning " href="{{ url('/withdrawals/waiting') }}">
                        @inject('Withdrawal', 'App\Http\Controllers\WithdrawalCtrl')
                        Withdrawals waiting
                        @if($Withdrawal->GetWaitingWithdrawalsCount() > 0)
                          <span class="badge">{{$Withdrawal->GetWaitingWithdrawalsCount()}}</span>
                        @endif
                      </a>
                    </div>
                  @endcan
                  @can('deposits.edit.verified')
                    <div style="text-align:center" class="col-sm-3 col-xs-12">
                      <a class="btn btn-info " href="{{ url('/deposits/verified') }}">

                        Deposits verified
                        @if($deposit->GetWaitingDepositsCount('verified') > 0)
                          <span class="badge">{{$deposit->GetWaitingDepositsCount('verified')}}</span>
                        @endif
                      </a>
                    </div>
                  @endcan
                  @can('withdrawals.edit.verified')
                    <div style="text-align:center" class="col-sm-3 col-xs-12">
                      <a class="btn btn-info " href="{{ url('/withdrawals/verified') }}">

                        Withdrawals verified
                        @if($Withdrawal->GetWaitingWithdrawalsCount('verified') > 0)
                          <span class="badge">{{$Withdrawal->GetWaitingWithdrawalsCount('verified')}}</span>
                        @endif
                      </a>
                    </div>
                  @endcan
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
