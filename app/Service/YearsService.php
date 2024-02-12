<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
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
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'name' => $request->name, 
                'active' => $request->active 
            ];
            $execute = $this->yearRepository->storeYears($data,$uuid);
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Tahun Berhasil dibuat !');
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
            $data = [
                'id' => $request->id,                
                'name' => $request->name, 
                'active' => $request->active 
            ];
            
            $execute = $this->yearRepository->updateYears($data);
            
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Tahun Berhasil diupdate !');
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
    public function viewallwithotpaging()
    {
        try {
            $find = $this->yearRepository->allYearswithoutPaging();
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