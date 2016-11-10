<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Cashier') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                @can('deposits.list')
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                      @inject('deposit', 'App\Http\Controllers\DepositsCtrl')

                      @if($deposit->GetWaitingDepositsCount() > 0 || $deposit->GetWaitingDepositsCount('verified') > 0)
                        <span class="badge badge-danger"><i class="glyphicon glyphicon-asterisk" ></i></span>
                      @endif Deposits <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                      @can('deposits.edit.waiting')
                        <li>
                            <a href="{{ url('/deposits/waiting') }}">

                              Deposits waiting
                              @if($deposit->GetWaitingDepositsCount() > 0)
                                <span class="badge badge-warning">{{$deposit->GetWaitingDepositsCount()}}</span>
                              @endif
                            </a>
                        </li>
                      @endcan
                      @can('deposits.edit.verified')
                      <li>
                          <a href="{{ url('/deposits/verified') }}">

                            Deposits verified
                            @if($deposit->GetWaitingDepositsCount('verified') > 0)
                              <span class="badge badge-info">{{$deposit->GetWaitingDepositsCount('verified')}}</span>
                            @endif
                          </a>
                      </li>
                      @endcan
                      <li>
                        <a href="{{ url('/deposits/all') }}">Deposits list</a>
                      </li>
                    </ul>
                  </li>
                @endcan
                @can('withdrawals.list')
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" href="{{ url('/withdrawals') }}">
                    @inject('Withdrawal', 'App\Http\Controllers\WithdrawalCtrl')

                    @if($Withdrawal->GetWaitingWithdrawalsCount() > 0 || $Withdrawal->GetWaitingWithdrawalsCount('verified') > 0)
                      <span class="badge badge-danger"><i class="glyphicon glyphicon-asterisk"></i></span>
                    @endif Withdrawals <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                      @can('withdrawals.edit.waiting')
                        <li>
                            <a href="{{ url('/withdrawals/waiting') }}">

                              Withdrawals waiting
                              @if($Withdrawal->GetWaitingWithdrawalsCount() > 0)
                                <span class="badge badge-warning">{{$Withdrawal->GetWaitingWithdrawalsCount()}}</span>
                              @endif
                            </a>
                        </li>
                      @endcan
                      @can('withdrawals.edit.verified')
                        <li>
                            <a href="{{ url('/withdrawals/verified') }}">

                              Withdrawals verified
                              @if($Withdrawal->GetWaitingWithdrawalsCount('verified') > 0)
                                <span class="badge badge-info">{{$Withdrawal->GetWaitingWithdrawalsCount('verified')}}</span>
                              @endif
                            </a>
                        </li>
                      @endcan
                      <li>
                        <a href="{{ url('/withdrawals/all') }}">withdrawals list</a>
                      </li>
                    </ul>
                  </li>
                @endcan
                @canatleast(['permission.list', 'role.list', 'user.list', 'app.list'])
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                          Admin area <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" role="menu">
                        @can('permission.list')
                            <li>
                                <a href="{{url('/permissions')}}">permissions</a>
                            </li>
                          @endcan
                          @can('role.list')
                            <li>
                                <a href="{{url('/roles')}}">roles</a>
                            </li>
                          @endcan
                          @can('user.list')
                            <li>
                                <a href="{{url('/users')}}">users</a>
                            </li>
                          @endcan
                          @can('app.list')
                            <li>
                                <a href="{{url('/apps')}}">apps</a>
                            </li>
                          @endcan
                      </ul>
                    </li>
                    @endcanatleast
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
