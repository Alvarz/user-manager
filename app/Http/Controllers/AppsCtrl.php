<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apps;
use Auth;

class AppsCtrl extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {
        if (Auth::user()->can('app.list')) {

            $data["apps"] = Apps::all();
            return view('modules/apps/apps')->with($data);

        }else{
            return view('permission');
        }
    }

    protected function create()
    {
        if (Auth::user()->can('app.add')) {

            return view('modules/apps/app-create');
        }else{
            return view('permission');
        }

    }

    protected function edit($IdApp)
    {
        if (Auth::user()->can('app.edit')) {

            $data['app'] = Apps::findOrFail($IdApp);

            return view('modules/apps/app-edit')->with($data);
        }else{
            return view('permission');
        }

    }

    protected function store(request $request)
    {
        if (Auth::user()->can('app.add')) {

            $this->validate(
                $request, [
                'name' => 'required|max:255',
                'url' => 'required|max:100'
                ]
            );

            $data = Apps::create(
                [
                'name' => $request['name'],
                'url' => $request['url'],
                'client_id' => uniqid().'-'.uniqid(),
                'api_token' => $this->MakeDBId().'-'.$this->MakeDBId(),

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
        }else{
            return array(
              'type' => 'alert-danger',
              'msg' => 'you cannot perform that action',
            'data' => '',
              );
        }

    }

    protected function update($idApp, request $request)
    {

        if (Auth::user()->can('app.edit')) {

            $this->validate(
                $request, [
                  'name' => 'required|max:255',
                  'url' => 'required|max:100'

                ]
            );

            $Apps = Apps::findOrFail($idApp);

            $Apps->name = $request['name'];
            $Apps->url = $request['url'];


            if ($Apps->save()) {
                    return array(
                    'type' => 'alert-success',
                    'msg' => 'success',
                    'data' => $Apps,
                    );
            }else{
                    return array(
                    'type' => 'alert-danger',
                    'msg' => 'error',
                    'data' => $Apps,
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

    protected function remove($IdApp)
    {
        if (Auth::user()->can('app.delete')) {

            $app = Apps::findOrFail($IdApp);

            if ($app->delete()) {
                return array(
                'type' => 'alert-success',
                'msg' => 'success borrando',
                'data' => $app,
                );
            }else{
                return array(
                'type' => 'alert-danger',
                'msg' => 'error borrando',
                'data' => $app,
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

    private function MakeDBId($yourTimestamp = null)
    {
        static $inc = 0;
        $id = '';

        if ($yourTimestamp === null) {
            $yourTimestamp = time();
        }
        $ts = pack('N', $yourTimestamp);
        $m = substr(md5(gethostname()), 0, 3);
        $pid = pack('n', posix_getpid());
        $trail = substr(pack('N', $inc++), 1, 3);
        $bin = sprintf("%s%s%s%s", $ts, $m, $pid, $trail);

        for ($i = 0; $i < 12; $i++) {
            $id .= sprintf("%02X", ord($bin[$i]));
        }

        return $id;
    }

}
