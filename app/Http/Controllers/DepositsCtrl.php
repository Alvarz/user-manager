<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Deposits;
use App\User;
use App\Players;
use Carbon\Carbon;
use Auth;
use App\Apps;

class DepositsCtrl extends Controller
{


    public function __construct()
    {

    }

    static function GetWaitingDepositsCount($filter = 'waiting')
    {

        return Deposits::where('status', '=', $filter)->count();
    }

    public function IndexPost(Request $request)
    {
        return redirect('deposits/'.$request->filter.'/true');

    }

    protected function index($filter = null, $page = false)
    {
        if (Auth::user()->can('deposits.list')) {

            $m_Deposits = new Deposits();

            $data["deposits"] = $this->getDeposits($filter, $page);
            $data["deposits"] = $m_Deposits->helper->searchWebsites($data["deposits"]);
            $data['filter'] = $filter;
            $data['apps'] = Apps::all();

            return view('modules/deposits/deposits')->with($data);

        }else{
            return view('permission');
        }
    }


    protected function depositDetails($IdDepost)
    {
        if (Auth::user()->can('deposits.list')) {

            $m_Players = new Players();
            $m_Deposits = new Deposits();

            $data['appName'] = Deposits::find($IdDepost)->App->name;
            // dd($app->name);

            $data['deposit'] = Deposits::findOrFail($IdDepost);
            $data['playerInfo'] = $m_Players->GetPlayerData($data['deposit']->IdPlayer);
            $data['playerInfo'] = $m_Players->helper->setFloatValuesAndFormatDatesForObj($data['playerInfo'])[0];
            $data['PlayerBalance'] = $m_Players->GetPlayerBalance($data['deposit']->IdPlayer, $data['playerInfo']->IdCurrency);
            $data['paymentMethod'] = $m_Deposits->GetPaymentMethods();

            if ($data['PlayerBalance']['@attributes']['ErrorCode'] == 0) {

                $data['PlayerBalance'] = $this->ManagePlayerBalanceData($data['PlayerBalance']);
            }

            if ($data['deposit']->status == 'verified' || $data['deposit']->status == 'rejected') {

                $data['user'] = Deposits::find($IdDepost)->UserReviewed;

            }elseif ($data['deposit']->status == 'approved') {

                $data['user'] = Deposits::find($IdDepost)->UserReviewed;
                $data['userApproved'] = Deposits::find($IdDepost)->UserApproved;

            }

            return view('modules/deposits/deposit-detail')->with($data);

        }else{
            return view('permission');
        }
    }



    protected function update($IdDepost, $idPlayer, $status, $payment_method)
    {

        if (Auth::user()->can('deposits.edit')) {


            $Deposit = Deposits::findOrFail($IdDepost);

            if ($status == 'verified' && $Deposit->status == 'waiting') {

                $Deposit->IdUser_reviewed = Auth::user()->id;
                $Deposit->reviewed_at =  Carbon::now();
                $Deposit->payment_method = $payment_method;
                $params = $this->SetArrayDataTransaction($Deposit);
                $response = Deposits::AddPlayerTransaction($params);
                $resTrasaction = empty($response);

                if (!$resTrasaction) {
                    return  $this->retornarError('there was an error', $response);
                }

            }elseif($status == 'approved' && $Deposit->status == 'verified') {

                $Deposit->IdUser_approved = Auth::user()->id;


            }elseif($status == 'verified' && $Deposit->status != 'waiting') {

                return  $this->retornarError('error this deposit was already verified by another user', $Deposit);

            }else{
                $resTrasaction = true;
                $Deposit->IdUser_reviewed = Auth::user()->id;
                $Deposit->reviewed_at =  Carbon::now();
            }


                $Deposit->status = $status;



            if ($Deposit->save() && $resTrasaction) {
                return array(
                'type' => 'alert-success',
                'msg' => 'the status has been updated',
                'data' => $Deposit,
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
            'transaction_type' => 'required|max:255',
            'voucher_img' => 'required|max:255',
            'voucher_number' => 'required|max:255',
            'origin_bank' => 'required|max:255',
            'IdPlayer' => 'required|max:255',
            ]
        );

        $data = Deposits::create(
            [
            'name' => $request['name'],
            'email' => $request['email'],
            'amount' => $request['amount'],
            'transaction_type' => $request['transaction_type'],
            'voucher_img' => $request['voucher_img'],
            'voucher_number' => $request['voucher_number'],
            'origin_bank' => $request['origin_bank'],
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

    private function getDeposits($filter = null, $page = false)
    {
        if ($page) {
            $retorno = Deposits::where('client_id', '=', $filter)->orderBy('updated_at', 'desc')->paginate(10);
        }elseif($filter == 'all') {
            $retorno = Deposits::paginate(10);
        }else{
            $retorno = Deposits::where('status', '=', $filter)->orderBy('updated_at', 'desc')->paginate(10);
        }
            return $retorno;
    }

    private function SetArrayDataTransaction($data)
    {

        return array(
          'prmIdPlayer' =>  $data->IdPlayer,
          'prmDescription' =>  $data->origin_bank,
          'prmAmount' =>  $data->amount,
          'prmReference' =>  $data->voucher_number,
          'prmFee' =>  0,
          'prmBonus' =>  0,
          'prmIdPaymentMethod' =>  $data->payment_method,
          'prmTransactionType' =>  'R',
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
