<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;  
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;

class SpecialistGroupService extends Controller
{
    private $SpecialistRepository;

    public function __construct(SpecialistGroupRepositoryInterface $SpecialistRepository)
    {
        $this->SpecialistRepository = $SpecialistRepository;
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
            $execute = $this->SpecialistRepository->storeSpecialistGroup($data,$uuid);
            DB::commit();
            if($execute){
                return $this->sendResponse($data, 'Specialist Group Berhasil dibuat !');
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
            $find = $this->SpecialistRepository->findSpecialistGroup($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Specialist Group tidak ditemukan !',[]);
            }

            $execute = $this->SpecialistRepository->updateSpecialistGroup($request);
            
            DB::commit();
            if($execute){
                return $this->sendResponse($execute, 'Specialist Group Berhasil diupdate !');
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
            $find = $this->SpecialistRepository->findSpecialistGroup($id); 
            if($find->count() < 1){
                return $this->sendError('Data Specialist Group tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Specialist Group ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->SpecialistRepository->allSpecialistGroup();
             
            if($find->count() < 1){
                return $this->sendError('Data Specialist Group tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Specialist Group ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}