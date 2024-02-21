<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Service\UserService;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->login($request);
        return $execute;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->storeData($request);
        return $execute;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->show($id);
        return $execute;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->updateData($request);
        return $execute;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function genToken(Request $request){
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->getTokenData($request);
        return $execute;
    }
    public function changepassword(Request $request){
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->changepassword($request);
        return $execute;
    }
    public function refreshToken(){
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->refreshToken();
        return $execute;
    }
    public function profile(Request $request){
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->profile($request);
        return $execute;
    }
    public function logout(){
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->logout();
        return $execute;
    }
    public function showall(){
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->showall();
        return $execute;
    }
    public function allUserswithoutPaging(){
        $userRepository =  new UserRepository(); 
        $aReturBeliService = new UserService(   
            $userRepository
        );
        $execute =  $aReturBeliService->allUserswithoutPaging();
        return $execute;
    }
}
