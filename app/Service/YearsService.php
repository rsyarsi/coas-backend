<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;  
use App\Repositories\Interfaces\YearRepositoryInterface;

class YearsService extends Controller
{
    private $yearRepository;

    public function __construct(YearRepositoryInterface $yearRepository)
    {
        $this->yearRepository = $yearRepository;
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
            $execute = $this->yearRepository->storeYears($request);
            DB::commit();
            if($execute){
                return $this->sendResponse($execute, 'Tahun Berhasil dibuat !');
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
            $find = $this->yearRepository->findYears($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Tahun tidak ditemukan !',[]);
            }

            $execute = $this->yearRepository->updateYears($request);
            
            DB::commit();
            if($execute){
                return $this->sendResponse($execute, 'Tahun Berhasil diupdate !');
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
            $find = $this->yearRepository->findYears($id);
             
            if($find->count() < 1){
                return $this->sendError('Data Tahun tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Tahun ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->yearRepository->allYears();
             
            if($find->count() < 1){
                return $this->sendError('Data Tahun tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Tahun ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}