<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\LectureRepository;
use App\Repositories\Interfaces\LectureRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;
use App\Repositories\UserRepository;

class LectureService extends Controller
{
    private $SpecialistRepository;
    private $lectureRepository;
    private $userRepository;

    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        LectureRepositoryInterface $lectureRepository,
        UserRepository $userRepository
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->lectureRepository = $lectureRepository;
        $this->userRepository = $userRepository;
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "specialistid" => "required", 
            "name" => "required", 
            "doctotidsimrs" => "required",            
            "nim" => "required",   
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findgroupspecialist = $this->SpecialistRepository->findSpecialist($request->specialistid);
      
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }

            $finslecturebyNim = $this->lectureRepository->findLecturebyNIM($request->nim);
            if($finslecturebyNim->count() > 0) {
                return $this->sendError('NIM atas Dosen ini sudah ada !', []);
            }

            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'specialistid' => $request->specialistid,
                'name' => $request->name,                 
                'nim' => $request->nim, 
                'doctotidsimrs' => $request->doctotidsimrs,  
                'active' => $request->active 
            ];
            $execute = $this->lectureRepository->storeLecture($data,$uuid);

            if($execute){
                $uuidx = Uuid::uuid4();
                $dataUser = [
                    'id' => $uuidx,                
                    'username' => $request->nim,
                    'email' => "-", 
                    'name' => $request->name,
                    'role' => "dosen", 
                    'password'  => bcrypt('123456')
                ];
                $this->userRepository->storeUser($dataUser,$uuidx);
            }

            DB::commit();

           
            return $this->sendResponse($data, 'Dosen Berhasil dibuat !');
            
            

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
            "name" => "required", 
            "doctotidsimrs" => "required",              
            "nim" => "required",    
            "active" => "required" 
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findgroupspecialist = $this->SpecialistRepository->findSpecialist($request->specialistid);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }
            $data = [
                'id' => $request->id,                
                'specialistid' => $request->specialistid,
                'name' => $request->name,                 
                'nim' => $request->nim, 
                'doctotidsimrs' => $request->doctotidsimrs,  
                'active' => $request->active 
            ];
            $execute = $this->lectureRepository->updateLecture($data);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Dosen Berhasil diupdate !');
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
    public function nim($id)
    {
        try {
            
            $find = $this->lectureRepository->findLecturebyNIM($id); 
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
    public function viewallwithotpaging()
    {
        try {
            $find = $this->lectureRepository->viewallwithotpaging();
             
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