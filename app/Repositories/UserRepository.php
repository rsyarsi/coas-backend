<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Year;
use Ramsey\Uuid\Uuid;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\YearRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function storeUser($request,$uuid)
    {
        
       
        return  User::create($request);
    } 

    public function login($request)
    {
        return  DB::table("users")
        ->select('name','username','name' ,'role')
        ->where('username', $request->username)
        ->where('password', bcrypt($request->password))
        ->get();
    }
    public function getTokenData($request)
    {
        $token = auth()->attempt(
            [
                "username" => $request->username,
                "password" => $request->password
            ]);
        return $token;
        
    }

    public function updateDateExpired($request,$access_token,$expired)
    {
        $updatesatuan =  DB::table('users')
        ->where('username', $request->username) 
            ->update([ 
                'access_token' =>  $access_token,
                'expired_at' =>  $expired 
            ]);
        return $updatesatuan;
    } 
}