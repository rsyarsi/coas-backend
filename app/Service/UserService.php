<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\YearRepositoryInterface;

class UserService extends Controller
{
    
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "username" => "required|unique:users",
            "password" => "required|confirmed"
        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        try {
            // Db Transaction
            DB::beginTransaction(); 
            $createUser = $this->userRepository->storeUser($request);
          
            DB::commit();
            if ($createUser) {
                return $this->sendResponse([],"Data Username Login berhasil dibuat.");
            } else {
                return $this->sendError("Data Username Login gagal dibuat.",[]); 
            }

        } catch (Exception $e) {
            DB::rollBack();
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function login(Request $request)
    {
        try {
            // validator  
            $request->validate([
                "username" => "required",
                "password" => "required" 
            ]);

             //login
            $loginUser = $this->userRepository->login($request);
            
            if ($loginUser->count() > 0) {
            
                return $this->sendResponse($loginUser ,"Anda berhasil Login.");  


            } else {
                //response
                return $this->sendError("Login gagal.", []);
            }

        } catch (Exception $e) { 
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function getTokenData (Request $request){
        try {
            // validator  
            $request->validate([
                "username" => "required",
                "password" => "required" 
            ]);

             //login
            $token = $this->userRepository->getTokenData($request);
            
            if ($token) {
                $this->userRepository->updateDateExpired($request,$token,Carbon::now()->addMinute()->format('Y-m-d H:i:s'));
                return $this->sendResponse($token ,"Token berhasil di refresh.");  
            } else {
                //response
                return $this->sendError("Token gagal di Refresh. Cek kembali Data Anda.", []);
            }

        } catch (Exception $e) { 
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}