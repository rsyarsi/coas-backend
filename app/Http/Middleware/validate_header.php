<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // baru

class validate_header
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //get token via header
        $token = $request->header('Authorization'); 
        if(empty($token)){

            $response = [
                'status' => false,
                'code' => 422,
                'message' => 'Authorization Header is empty',
            ];
            return response()->json($response, 422);

        }

        //format bearer token : 
        //Bearer[spasi]randomhashtoken 
        $pecah_token = explode(" ", $token);
        if(count($pecah_token) <> 2){
            $response = [
                'status' => false,
                'code' => 422,
                'message' => 'Invalid Authorization format',
            ];
            return response()->json($response, 422);
        }

        if(trim($pecah_token[0]) <> 'Bearer'){
            $response = [
                'status' => false,
                'code' => 422,
                'message' => 'Authorization header must be a Bearer',
            ];
            return response()->json($response, 422);
        }

        $access_token = trim($pecah_token[1]);

        //cek apakah access_token ini ada di database atau tidak
        // $cek =  DB::table("users")
        //         ->where('access_token', $access_token)->first();
        // if(empty($cek)){
        //     $response = [
        //         'status' => false,
        //         'code' => 422,
        //         'message' => 'Forbidden : Invalid access token',
        //     ];
        //     return response()->json($response, 422);
        // }

        //cek apakah access_token expired atau tidak
        // if(strtotime($cek->expired_at) < time()){
 
        //     $response = [
        //         'status' => false,
        //         'code' => 422,
        //         'message' => 'Forbidden : Token is already expired. ',
        //     ];
        //     return response()->json($response, 422);

        // }

        //jika semua kondisi dipenuhi, lanjutkan request
        return $next($request);
    }
}
