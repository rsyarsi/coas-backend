<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\universityRepositoryInterface; 

class UniversitieService extends Controller
{
    private $universityRepository;

    public function __construct(UniversityRepositoryInterface $universityRepository)
    {
        $this->universityRepository = $universityRepository;
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
            $execute = $this->universityRepository->storeUniversity($data,$uuid);
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Universitas Berhasil dibuat !');
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
            $find = $this->universityRepository->findUniversity($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Universitas tidak ditemukan !',[]);
            }

            $execute = $this->universityRepository->updateUniversity($request);
            
            DB::commit();
            if($execute){
                return $this->sendResponse($execute, 'Universitas Berhasil diupdate !');
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
            $find = $this->universityRepository->findUniversity($id);
             
            if($find->count() < 1){
                return $this->sendError('Data Universitas tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Universitas ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->universityRepository->allUniversity();
             
            if($find->count() < 1){
                return $this->sendError('Data Universitas tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Universitas ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}