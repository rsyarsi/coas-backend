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
use Tripteki\RequestResponseQuery\QueryBuilder;

class UserRepository implements UserRepositoryInterface
{
    public function storeUser($request,$uuid)
    {
        
        return  User::create($request);
    } 
    public function updateData($request)
    {
        
        $updates = User::where('id', $request['id'])->update($request);
        return $updates;
    } 
    public function changepassword($request)
    {
 
        $updates = User::where('username', $request->username)->update([
            'password' =>  bcrypt($request->password)
        ]);
        return $updates;
    } 
    public function allUser()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(User::class)->
        defaultSort("-id")->
        allowedSorts([ "id", "name", "role", "username", "email", "updated_at", ])->
        allowedFilters([ "id", "name", "role", "username", "email", ])->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    } 
    public function allUserswithoutPaging()
    {
        return  User::select('id','name','role','username','email')->get();
    } 
    public function login($request)
    {
        return  DB::table("users")
        ->select('name','username','name' ,'role')
        ->where('username', $request->username)
        ->where('password', bcrypt($request->password))
        ->get();
    }
    public function loginResetpassword($request)
    {
        
        return  DB::table("users")
        ->select('name','username','name' ,'role')
        ->where('username', $request->username) 
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
    public function refreshToken(){
        return  auth()->refresh();
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
    public function profile($request){
        return User::select('id','name','role','username','email')
        ->where('username',$request->username)->get();
    }
    public function showbyid($id){
        return User::select('id','name','role','username','email')
        ->where('id',$id)->get();
    }
    public function logout(){
        return  auth()->logout();
    }
}