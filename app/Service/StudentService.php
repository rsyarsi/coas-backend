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
use App\Repositories\StudentRepository;
use App\Repositories\HospitalRepository;
use App\Repositories\SemesterRepository;
use App\Repositories\UniversityRepository;
use App\Repositories\Interfaces\LectureRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\Interfaces\SpecialistGroupRepositoryInterface;

class StudentService extends Controller
{
    private $SpecialistRepository;
    private $lectureRepository;
    private $semesterRepository;
    private $universityRepository;
    private $hospitalRepository;
    private $studentRepository;


    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        LectureRepositoryInterface $lectureRepository,
        SemesterRepository $semesterRepository,
        UniversityRepository $universityRepository,
        HospitalRepository $hospitalRepository,
        StudentRepository $studentRepository
        
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->lectureRepository = $lectureRepository;
        $this->semesterRepository = $semesterRepository;
        $this->universityRepository = $universityRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->studentRepository = $studentRepository; 
    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "name" => "required", 
            "nim" => "required", 
            "semesterid" => "required", 
            "specialistid" => "required", 
            "datein" => "required", 
            "university" => "required",   
            "hospitalfrom" => "required",   
            "hospitalto" => "required",   
            "active" => "required",    
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findgroupspecialist = $this->SpecialistRepository->findSpecialist($request->specialistid);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }



            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,                
                'name' => $request->name,
                'nim' => $request->nim, 
                'semesterid' => $request->semesterid,  
                'specialistid' => $request->specialistid,  
                'datein' => $request->datein,  
                'university' => $request->university,  
                'hospitalfrom' => $request->hospitalfrom,  
                'hospitalto' => $request->hospitalto,  
                'active' => $request->active 
            ];
            $execute = $this->studentRepository->storeStudent($data,$uuid);
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Mahasiswa Berhasil dibuat !');
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
            "nim" => "required", 
            "semesterid" => "required", 
            "specialistid" => "required", 
            "datein" => "required", 
            "university" => "required",   
            "hospitalfrom" => "required",   
            "hospitalto" => "required",   
            "active" => "required",    
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
                'name' => $request->name,
                'nim' => $request->nim, 
                'semesterid' => $request->semesterid,  
                'specialistid' => $request->specialistid,  
                'datein' => $request->datein,  
                'university' => $request->university,  
                'hospitalfrom' => $request->hospitalfrom,  
                'hospitalto' => $request->hospitalto,  
                'active' => $request->active 
            ];
            $execute = $this->studentRepository->updateStudent($data);
        
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Mahasiswa Berhasil diupdate !');
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
            
            $find = $this->studentRepository->findStudent($id); 
            if($find->count() < 1){
                return $this->sendError('Data Mahasiswa tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Mahasiswa ditemukan !');

        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showall()
    {
        try {
            $find = $this->studentRepository->allStudent();
             
            if($find->count() < 1){
                return $this->sendError('Data Mahasiswa tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Mahasiswa ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}