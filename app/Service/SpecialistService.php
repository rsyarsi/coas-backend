<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;  
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;

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
            "groupspecialistID" => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findgroupspecialist = $this->SpecialistGroupRepository->findSpecialistGroup($request->groupspecialistID);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Group Specialist tidak di temukan !', []);
            }
            $execute = $this->SpecialistRepository->storeSpecialist($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($execute, 'Specialist Berhasil dibuat !');
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
            "groupspecialistID" => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->SpecialistRepository->findSpecialist($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Data Specialist tidak ditemukan !',[]);
            }

            $findgroupspecialist = $this->SpecialistGroupRepository->findSpecialistGroup($request->groupspecialistID);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Group Specialist tidak di temukan !', []);
            }

            $execute = $this->SpecialistRepository->updateSpecialist($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($execute, 'Specialist Berhasil diupdate !');
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
}