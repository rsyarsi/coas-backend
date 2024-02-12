<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;  
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;

class SpecialistService extends Controller
{
    private $SpecialistRepository;
    private $SpecialistGroupRepository;

    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        SpecialistGroupRepositoryInterface $SpecialistGroupRepository
        
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->SpecialistGroupRepository = $SpecialistGroupRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "specialistname" => "required", 
            "groupspecialistid" => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findgroupspecialist = $this->SpecialistGroupRepository->findSpecialistGroup($request->groupspecialistid);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Group Specialist tidak di temukan !', []);
            }
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'specialistname' => $request->specialistname, 
                'groupspecialistid' => $request->groupspecialistid, 
                'active' => $request->active 
            ];
            $execute = $this->SpecialistRepository->storeSpecialist($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Specialist Berhasil dibuat !');
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
            "specialistname" => "required", 
            "groupspecialistid" => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->SpecialistRepository->findSpecialist($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Specialist tidak ditemukan !',[]);
            }

            $findgroupspecialist = $this->SpecialistGroupRepository->findSpecialistGroup($request->groupspecialistid);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Group Specialist tidak di temukan !', []);
            }
            $data = [
                'id' => $request->id,                
                'specialistname' => $request->specialistname, 
                'groupspecialistid' => $request->groupspecialistid, 
                'active' => $request->active 
            ];
            $execute = $this->SpecialistRepository->updateSpecialist($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Specialist Berhasil diupdate !');
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
            
            $find = $this->SpecialistRepository->findSpecialist($id); 
            if($find->count() < 1){
                return $this->sendError('Data Specialist tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Specialist ditemukan !');

        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->SpecialistRepository->allSpecialist();
             
            if($find->count() < 1){
                return $this->sendError('Data Specialist tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Specialist ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function viewallwithotpaging()
    {
        try {
            $find = $this->SpecialistRepository->viewallwithotpaging();
             
            if($find->count() < 1){
                return $this->sendError('Data Specialist tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Specialist ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}