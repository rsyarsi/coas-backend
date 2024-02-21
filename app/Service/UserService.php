<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Interfaces\UserRepositoryInterface; 

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
            "password" => "required|confirmed",         
            "role" => "required"

        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }
        
        try {
            // Db Transaction
            DB::beginTransaction(); 
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                'username' => $request->username,
                'email' => $request->email, 
                'name' => $request->name,
                'role' => $request->role, 
                'access_token' => $request->access_token, 
                'password'  => bcrypt($request->password)
            ];
            $createUser = $this->userRepository->storeUser($data,$uuid);
            DB::commit();

            if ($createUser) {
                return $this->sendResponse($data,"Data Username Login berhasil dibuat.");
            } else {
                return $this->sendError("Data Username Login gagal dibuat.",[]); 
            }

        } catch (Exception $e) {
            DB::rollBack();
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function updateData(Request $request)
    {
        // validate 
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "email" => "required|email",        
            "role" => "required"

        ]);

        if ($validator->fails()){
            return response()->json($validator->errors(),400);
        }

        try {
            // Db Transaction
            DB::beginTransaction();  
            $data = [
                'id' => $request->id,
                'email' => $request->email, 
                'name' => $request->name,
                'role' => $request->role
            ];
            $createUser = $this->userRepository->updateData($data);
            DB::commit();

            if ($createUser) {
                return $this->sendResponse($data,"Data Username Login berhasil dirubah.");
            } else {
                return $this->sendError("Data Username Login gagal dirubah.",[]); 
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

            if (! $token = $this->userRepository->getTokenData($request)) {
                // return response()->json(['error' => 'Unauthorized'], 401);
                return $this->sendError("Unauthorized.", []);
            }else{
                $this->userRepository->updateDateExpired($request,$token,Carbon::now()->addMinute()->format('Y-m-d H:i:s'));
                return $this->respondWithToken($token);
            }
    
        } catch (Exception $e) { 
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function refreshToken(){
        try {
           
            $token = $this->userRepository->refreshToken();
            return $this->respondWithToken($token);
        } catch (Exception $e) { 
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    protected function respondWithToken($token)
    {
        $token =[
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60 * 24
        ];

        return $this->sendResponse($token ,"Anda berhasil Login.");  
    }
    public function getTokenData (Request $request){
        try {
            // validator  
            $request->validate([
                "username" => "required",
                "password" => "required" 
            ]);

             //login
            $token = $this->userRepository->refresh($request);
            
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
    public function profile(Request $request){
        try {
            // validator  
            $request->validate([
                "username" => "required"  
            ]);

             //login
            $user = $this->userRepository->profile($request);
            
            if ($user) {
                
                return $this->sendResponse($user ,"User Profile ditemukan.");  
            } else {
                //response
                return $this->sendError("ser Profile tidak ditemukan", []);
            }

        } catch (Exception $e) { 
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function logout(){
        try {
            // validator  
            
             //login
            $user = $this->userRepository->logout();
            return $this->sendResponse($user ,"User Profile logout.");  

        } catch (Exception $e) { 
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->userRepository->allUser();
             
            if($find->count() < 1){
                return $this->sendError('Data Username tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Username ditemukan !');
        } catch (Exception $e) { 
            // Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function allUserswithoutPaging()
    {
        try {
            $find = $this->userRepository->allUserswithoutPaging();
             
            if($find->count() < 1){
                return $this->sendError('Data Username tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Username ditemukan !');
        } catch (Exception $e) { 
            // Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function show($id){
        try {    

             //login
            $user = $this->userRepository->showbyid($id);
            
            if ($user->count() > 0 ) {
                
                return $this->sendResponse($user ,"User ditemukan.");  
            } else {
                //response
                return $this->sendError("User tidak ditemukan", []);
            }

        } catch (Exception $e) { 
            //Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}