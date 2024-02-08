<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\LectureRepositoryInterface;
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\LectureRepository;

class LectureService extends Controller
{
    private $SpecialistRepository;
    private $lectureRepository;

    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        LectureRepositoryInterface $lectureRepository
        
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->lectureRepository = $lectureRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "specialistID" => "required", 
            "name" => "required", 
            "doctotidsimrs" => "required",   
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findgroupspecialist = $this->SpecialistRepository->findSpecialist($request->specialistID);
      
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }
            $execute = $this->lectureRepository->storeLecture($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($execute, 'Dosen Berhasil dibuat !');
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
            "specialistID" => "required", 
            "name" => "required", 
            "doctotidsimrs" => "required",   
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findgroupspecialist = $this->SpecialistRepository->findSpecialist($request->specialistID);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }
 
            $execute = $this->lectureRepository->updateLecture($request);
            DB::commit();

            if($execute){
                return $this->sendResponse($execute, 'Dosen Berhasil diupdate !');
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
            
            $find = $this->lectureRepository->findLecture($id); 
            if($find->count() < 1){
                return $this->sendError('Data Dosen tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Dosen ditemukan !');

        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->lectureRepository->allLecture();
             
            if($find->count() < 1){
                return $this->sendError('Data Dosen tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Dosen ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}