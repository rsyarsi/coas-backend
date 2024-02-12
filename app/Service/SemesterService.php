<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; 
use App\Repositories\Interfaces\semesterRepositoryInterface;

class SemesterService extends Controller
{
    private $semesterRepository;

    public function __construct(SemesterRepositoryInterface $semesterRepository)
    {
        $this->semesterRepository = $semesterRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "semestername" => "required",
            "semestervalue" => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'semestername' => $request->semestername,                 
                'semestervalue' => $request->semestervalue,  
                'active' => $request->active 
            ];
            $execute = $this->semesterRepository->storeSemester($data,$uuid);
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Semster Berhasil dibuat !');
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
            "semestername" => "required",
            "semestervalue" => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->semesterRepository->findSemester($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Semester tidak ditemukan !',[]);
            }
            $data = [
                'id' => $request->id,                
                'semestername' => $request->semestername,                 
                'semestervalue' => $request->semestervalue,  
                'active' => $request->active 
            ];
            $execute = $this->semesterRepository->updateSemester($request);
            
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Semester Berhasil diupdate !');
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
            $find = $this->semesterRepository->findSemester($id); 
            if($find->count() < 1){
                return $this->sendError('Data Semester tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Semester ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->semesterRepository->allSemester();
             
            if($find->count() < 1){
                return $this->sendError('Data Semester tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Semester ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}