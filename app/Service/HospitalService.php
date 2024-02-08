<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\HospitalRepositoryInterface; 

class HospitalService extends Controller
{
    private $hospitalRepository;

    public function __construct(HospitalRepositoryInterface $hospitalRepository)
    {
        $this->hospitalRepository = $hospitalRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([
            "name" => "required",
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $execute = $this->hospitalRepository->storeHospital($request);
            DB::commit();
            if($execute){
                return $this->sendResponse($execute, 'Rumah Sakit Berhasil dibuat !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    public function update(Request $request)
    {
        $request->validate([
            "name" => "required",
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->hospitalRepository->findHospital($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Rumah Sakit tidak ditemukan !',[]);
            }

            $execute = $this->hospitalRepository->updateHospital($request);
            
            DB::commit();
            if($execute){
                return $this->sendResponse($execute, 'Rumah Sakit Berhasil diupdate !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function show($id)
    {
        try {
            $find = $this->hospitalRepository->findHospital($id);
             
            if($find->count() < 1){
                return $this->sendError('Data Rumah Sakit tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Rumah Sakit ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->hospitalRepository->allHospital();
             
            if($find->count() < 1){
                return $this->sendError('Data Rumah Sakit tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Rumah Sakit ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}