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
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;

class AssesmentGroupService extends Controller
{
    private $SpecialistRepository;
    private $AssesmentGroupRepository;

    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        AssesmentGroupRepositoryInterface $AssesmentGroupRepository
        
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->AssesmentGroupRepository = $AssesmentGroupRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "specialistid" => "required", 
            "assementgroupname" => "required",             
            "valuetotal" => "required",   
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findspecialist = $this->SpecialistRepository->findSpecialist($request->specialistid);
            if($findspecialist->count() < 1){
                return $this->sendError('Spesialis tidak ditemukan !', []);
            }
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'specialistid' => $request->specialistid,
                'assementgroupname' => $request->assementgroupname, 
                'type' => $request->type, 
                'valuetotal' => $request->valuetotal, 
                'active' => $request->active 
            ];

            $execute = $this->AssesmentGroupRepository->storeAssesmentGroup($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Group Penilaian Berhasil dibuat !');
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
            "specialistid" => "required", 
            "assementgroupname" => "required", 
            'valuetotal' => "required", 
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $find = $this->AssesmentGroupRepository->findAssesmentGroup($request->id);
             
            if($find->count() < 1){
                return $this->sendError('Group Penilaian tidak ditemukan !',[]);
            }

            $findspecialist = $this->SpecialistRepository->findSpecialist($request->specialistid);
            if($findspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }
            $data = [
                'id' => $request->id,         
                'specialistid' => $request->specialistid,
                'assementgroupname' => $request->assementgroupname, 
                'type' => $request->type, 
                'valuetotal' => $request->valuetotal, 
                'active' => $request->active 
            ];
            $execute = $this->AssesmentGroupRepository->updateAssesmentGroup($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Group Penilaian Berhasil diupdate !');
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
            
            $find = $this->AssesmentGroupRepository->findAssesmentGroup($id); 
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');

        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->AssesmentGroupRepository->allAssesmentGroup();
             
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function viewallwithotpaging()
    {
        try {
            $find = $this->AssesmentGroupRepository->viewallwithotpaging();
             
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function byspecialist($id)
    {
        try {
            $find = $this->AssesmentGroupRepository->findAssesmentGroupbyspecialist($id);
             
            if($find->count() < 1){
                return $this->sendError('Data Group Penilaian tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Group Penilaian ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}