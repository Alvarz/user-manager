<?php

namespace App\Http\Middleware;

use Closure;
use App\Apps;


class authApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $res = $this->GetAuth($request);

        if ($res == null) {
            $response =  json_encode(
                array(
                'errorCode' => 1,
                'msg' => 'api does not exist',
                'state' => false,
                'data' => $request
                )
            );
              return response($response, 200)->header('Content-Type', 'text/plain');

        }else{
            return $next($request);
        }

    }

    private function GetAuth($request)
    {
        // $request->headers->get('api_token');
        $referer = $request->header('referer');
        $origin = $request->header('origin');
        $host = $request->header('host');
        $api_token = $request->header('api_token');
        $client_id = $request->header('client_id');

        return Apps::where('api_token', $api_token)->where('client_id', $client_id)->first();

    }
}
