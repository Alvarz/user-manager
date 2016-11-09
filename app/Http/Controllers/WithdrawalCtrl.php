<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\withdrawal;
use Auth;
use App\Players;
use App\Deposits;
use App\User;

class WithdrawalCtrl extends Controller
{
    public function __construct()
    {

    }

    static function GetWaitingWithdrawalsCount()
    {

        return withdrawal::where('status', '=', 'waiting review')->count();
    }

    protected function index($filter = null)
    {
        if (Auth::user()->can('withdrawals.list')) {

            $m_Deposits = new Deposits();

            $data["withdrawals"] = $this->getWithdrawals($filter);
            $data["withdrawals"] = $m_Deposits->helper->searchWebsites($data["withdrawals"], true);

            return view('modules/withdrawals/withdrawals')->with($data);

        }else{
            return view('permission');
        }
    }


    protected function withdrawalsDetails($IdDepost)
    {
        if (Auth::user()->can('withdrawals.list')) {

            $m_Players = new Players();
            $m_Deposits = new Deposits();

            $data['appName'] = withdrawal::find($IdDepost)->App->name;

            $data['withdrawal'] = withdrawal::findOrFail($IdDepost);
            $data['playerInfo'] = $m_Players->GetPlayerData($data['withdrawal']->IdPlayer);
            $data['playerInfo'] = $m_Players->helper->setFloatValuesAndFormatDatesForObj($data['playerInfo'])[0];
            $data['PlayerBalance'] = $m_Players->GetPlayerBalance($data['withdrawal']->IdPlayer, $data['playerInfo']->IdCurrency);
            $data['paymentMethod'] = $m_Deposits->GetPaymentMethods();

            if ($data['PlayerBalance']['@attributes']['ErrorCode'] == 0) {

                $data['PlayerBalance'] = $this->ManagePlayerBalanceData($data['PlayerBalance']);
            }

            if ($data['withdrawal']->status != 'waiting review') {

                $data['user'] = User::findOrFail($data['withdrawal']->IdUser_reviewed);

            }
            // dd($data);

            return view('modules/withdrawals/withdrawals-detail')->with($data);

        }else{
            return view('permission');
        }
    }

    protected function update($IdWithdrawal, $idPlayer, $status, $payment_method)
    {

        if (Auth::user()->can('withdrawals.edit')) {


            $Withdrawal = withdrawal::findOrFail($IdWithdrawal);

            $Withdrawal->status = $status;
            $Withdrawal->IdUser_reviewed = Auth::user()->id;
            $Withdrawal->payment_method = $payment_method;

            if ($status == 'approved') {

                $params = $this->SetArrayDataTransaction($Withdrawal);
                $resTrasaction = empty(Deposits::AddPlayerTransaction($params));

            }else{
                $resTrasaction = true;
            }


            if ($Withdrawal->save() && $resTrasaction) {
                    return array(
                    'type' => 'alert-success',
                    'msg' => 'the status has been updated',
                    'data' => $Withdrawal,
                    );
            }else{
                    return array(
                    'type' => 'alert-danger',
                    'msg' => 'error updating status',
                    'data' => $Withdrawal,
                    );
            }
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'you cannot perform that action',
            'data' => '',
            );
        }
    }



    protected function store(request $request)
    {
        // if (Auth::user()->can('deposits.add')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'amount' => 'required',
                'destination_bank' => 'required|max:255',
                'account_number' => 'required|max:255',
                'IdPlayer' => 'required|max:255',
                ]
            );

            $data = withdrawal::create(
                [
                'name' => $request['name'],
                'email' => $request['email'],
                'amount' => $request['amount'],
                'destination_bank' => $request['destination_bank'],
                'account_number' => $request['account_number'],
                'status' => 'waiting review',
                'IdPlayer' => $request['IdPlayer'],
                ]
            );

        if ($data) {
            return array(
            'type' => 'alert-success',
            'msg' => 'success',
            'data' => $data
            );
        }else{
            return array(
            'type' => 'alert-danger',
            'msg' => 'error',
            'data' => $data,
            );
        }
        // }else{
        //     return array(
        //     'type' => 'alert-danger',
        //     'msg' => 'you cannot perform that action',
        //     'data' => '',
        //     );
        // }
    }

    /*****************************************************************/
    /*************************PRIVATE FUNCTIONS *********************/
    /*****************************************************************/

    private function ManagePlayerBalanceData($PlayerBalance)
    {
        $PlayerBalance = $PlayerBalance['@attributes'];
        $PlayerBalance['RealAvailBalance'] =  explode(" ", $PlayerBalance['RealAvailBalance'])[0];
        $PlayerBalance['AmountAtRisk'] = explode(" ", $PlayerBalance['AmountAtRisk'])[0];
        $PlayerBalance['CreditLimit'] = explode(" ", $PlayerBalance['CreditLimit'])[0];
        $PlayerBalance['FreePlayAmount'] = explode(" ", $PlayerBalance['FreePlayAmount'])[0];
        $PlayerBalance['BonusPoints'] = explode(" ", $PlayerBalance['BonusPoints'])[0];

        return $PlayerBalance;
    }

    private function getWithdrawals($filter = null)
    {
        switch ($filter) {
        case 'rejected':
            $retorno = withdrawal::where('status', '=', 'rejected')->orderBy('updated_at', 'desc')->paginate(10);
            break;
        case 'approved':
            $retorno = withdrawal::where('status', '=', 'approved')->orderBy('updated_at', 'desc')->paginate(10);
            break;
        case 'waiting':
            $retorno = withdrawal::where('status', '=', 'waiting review')->orderBy('updated_at', 'desc')->paginate(10);
            break;
        default:
            $retorno = withdrawal::orderBy('updated_at', 'desc')->paginate(10);
            break;
        }
        return $retorno;
    }

    private function SetArrayDataTransaction($data)
    {

        return array(
          'prmIdPlayer' =>  $data->IdPlayer,
          'prmDescription' =>  $data->destination_bank,
          'prmAmount' =>  (float)$data->amount * -1,
          'prmReference' =>  $data->account_number,
          'prmFee' =>  0,
          'prmBonus' =>  0,
          'prmIdPaymentMethod' =>  $data->payment_method,
          'prmTransactionType' =>  'D',
          'prmIdUser' =>  0,
          'prmOutPrevAvailBalance' =>  0,
          'prmOutIdTransaction' =>  0
                );

    }
}
