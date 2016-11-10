<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\withdrawal;
use Auth;
use App\Players;
use App\Deposits;
use App\User;
use App\Apps;
use Carbon\Carbon;

class WithdrawalCtrl extends Controller
{
    public function __construct()
    {

    }

    static function GetWaitingWithdrawalsCount($filter = 'waiting')
    {

        return withdrawal::where('status', '=', $filter)->count();
    }

    public function IndexPost(Request $request)
    {
        return redirect('withdrawals/'.$request->filter.'/true');

    }

    protected function index($filter = null, $page = false)
    {
        if (Auth::user()->can('withdrawals.list')) {

            $m_Deposits = new Deposits();

            $data["withdrawals"] = $this->getWithdrawals($filter, $page);
            $data["withdrawals"] = $m_Deposits->helper->searchWebsites($data["withdrawals"], true);
            $data['filter'] = $filter;
            $data['apps'] = Apps::all();


            return view('modules/withdrawals/withdrawals')->with($data);

        }else{
            return view('permission');
        }
    }


    protected function withdrawalsDetails($IdWithdrawal)
    {
        if (Auth::user()->can('withdrawals.list')) {

            $m_Players = new Players();
            $m_Deposits = new Deposits();

            $data['appName'] = withdrawal::find($IdWithdrawal)->App->name;

            $data['withdrawal'] = withdrawal::findOrFail($IdWithdrawal);
            $data['playerInfo'] = $m_Players->GetPlayerData($data['withdrawal']->IdPlayer);
            $data['playerInfo'] = $m_Players->helper->setFloatValuesAndFormatDatesForObj($data['playerInfo'])[0];
            $data['PlayerBalance'] = $m_Players->GetPlayerBalance($data['withdrawal']->IdPlayer, $data['playerInfo']->IdCurrency);
            $data['paymentMethod'] = $m_Deposits->GetPaymentMethods();

            if ($data['PlayerBalance']['@attributes']['ErrorCode'] == 0) {

                $data['PlayerBalance'] = $this->ManagePlayerBalanceData($data['PlayerBalance']);
            }

            if ($data['withdrawal']->status == 'verified') {

                $data['user'] = withdrawal::find($IdWithdrawal)->UserReviewed;

            }elseif ($data['withdrawal']->status == 'approved') {

                $data['user'] = withdrawal::find($IdWithdrawal)->UserReviewed;
                $data['userApproved'] = withdrawal::find($IdWithdrawal)->UserApproved;

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

            if ($status == 'verified' && $Withdrawal->status == 'waiting' ) {

                $Withdrawal->IdUser_reviewed = Auth::user()->id;
                $Withdrawal->reviewed_at =  Carbon::now();
                $Withdrawal->payment_method = $payment_method;
                $params = $this->SetArrayDataTransaction($Withdrawal);
                $response = Deposits::AddPlayerTransaction($params);
                $resTrasaction = empty($response);

                if (!$resTrasaction) {
                    return  $this->retornarError('there was an error', $response);
                }

            }elseif($status == 'approved' && $Withdrawal->status == 'verified') {

                $Withdrawal->IdUser_approved = Auth::user()->id;



            }elseif($status == 'verified' && $Withdrawal->status != 'waiting') {

                return  $this->retornarError('error this Withdrawal was already verified by another user', $Withdrawal);

            }else{
                $resTrasaction = true;
            }

            $Withdrawal->status = $status;




            if ($Withdrawal->save() && $resTrasaction) {
                    return array(
                    'type' => 'alert-success',
                    'msg' => 'the status has been updated',
                    'data' => $Withdrawal,
                    );
            }else{
                  return $this->retornarError();
            }
        }else{
            return $this->retornarError('you cannot perform that action');
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
                'status' => 'waiting',
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

    private function getWithdrawals($filter = null, $page = false)
    {

        if ($page) {
            $retorno = withdrawal::where('client_id', '=', $filter)->orderBy('updated_at', 'desc')->paginate(10);
        }elseif($filter == 'all') {
            $retorno = withdrawal::paginate(10);
        }else{
            $retorno = withdrawal::where('status', '=', $filter)->orderBy('updated_at', 'desc')->paginate(10);
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

    private function retornarError($msg = 'error updating status', $data='')
    {
        return array(
        'type' => 'alert-danger',
        'msg' => $msg,
        'data' => $data,
        );
    }
}
