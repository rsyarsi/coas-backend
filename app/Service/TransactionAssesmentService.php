<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\AssesmentGroupRepository;
use App\Repositories\StudentRepository;
use App\Repositories\HospitalRepository;
use App\Repositories\SemesterRepository;
use App\Repositories\UniversityRepository;
use App\Repositories\Interfaces\LectureRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\TransactionAssesmentRepository;
use App\Repositories\YearRepository;

class TransactionAssesmentService extends Controller
{
    private $SpecialistRepository;
    private $lectureRepository;
    private $semesterRepository;
    private $universityRepository;
    private $hospitalRepository;
    private $studentRepository;
    private $transactionassesmentRepository;
    private $yearRepository;
    private $groupAssesmentRepository;

    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        LectureRepositoryInterface $lectureRepository,
        SemesterRepository $semesterRepository,
        UniversityRepository $universityRepository,
        HospitalRepository $hospitalRepository,
        StudentRepository $studentRepository,
        TransactionAssesmentRepository $transactionassesmentRepository,
        YearRepository $yearRepository,
        AssesmentGroupRepository $groupAssesmentRepository
        
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->lectureRepository = $lectureRepository;
        $this->semesterRepository = $semesterRepository;
        $this->universityRepository = $universityRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->studentRepository = $studentRepository;  
        $this->transactionassesmentRepository = $transactionassesmentRepository; 
        $this->yearRepository = $yearRepository; 
        $this->groupAssesmentRepository = $groupAssesmentRepository; 
    }

    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "assesmentgroupid" => "required", 
            "studentid" => "required", 
            "lectureid" => "required", 
            "yearid" => "required", 
            "semesterid" => "required", 
            "grandotal" => "required",    
            "specialistid" => "required", 
            "transactiondate"   => "required", 
            "active" => "required",    
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 

            
            $findstudent = $this->studentRepository->findStudent($request->studentid);
            if($findstudent->count() < 1){
                return $this->sendError('Mahasiswa tidak di temukan !', []);
            }
            $findlecture = $this->lectureRepository->findLecture($request->lectureid);
            if($findlecture->count() < 1){
                return $this->sendError('Dosen tidak di temukan !', []);
            }
            $findsemester = $this->semesterRepository->findSemester($request->semesterid);
            if($findsemester->count() < 1){
                return $this->sendError('Semester tidak di temukan !', []);
            }
            $findyear = $this->yearRepository->findYears($request->yearid);
            if($findyear->count() < 1){
                return $this->sendError('Tahun tidak di temukan !', []);
            }
            $findgroupspecialist = $this->SpecialistRepository->findSpecialist($request->specialistid);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }
            $findassesmentgroup = $this->groupAssesmentRepository->findAssesmentGroup($request->assesmentgroupid);
            if($findassesmentgroup->count() < 1){
                return $this->sendError('Assesment group tidak di temukan !', []);
            }
            
            $verify = $this->transactionassesmentRepository->verifyTrsAssesment($request,$findassesmentgroup->first()->type);
            
            if($verify->count() < 1){
                $uuid = Uuid::uuid4();
                $data = [
                    'id' => $uuid,                
                    'assesmentgroupid' => $request->assesmentgroupid,
                    'studentid' => $request->studentid, 
                    'lectureid' => $request->lectureid,  
                    'yearid' => $request->yearid,  
                    'semesterid' => $request->semesterid,  
                    'specialistid' => $request->specialistid,  
                    'grandotal' => $request->grandotal,   
                    'assesmenttype' => $findassesmentgroup->first()->type,   
                    'active' => $request->active 
                ];
    
                $this->transactionassesmentRepository->storeTrsAssesment($data,$uuid);
                $date = Carbon::now();
                $verify2 = $this->transactionassesmentRepository->findassesmentbygrouptype($request,$findassesmentgroup->first()->type);
                    
                foreach ($verify2 as $key ) {
                    # code...
                    $uuiddetail = Uuid::uuid4();
                    if($findassesmentgroup->first()->type == "1"){
                        $this->transactionassesmentRepository->storeTrsAssesmentDetailone($key,$uuid,$uuiddetail,$date);
                    }else if($findassesmentgroup->first()->type == "3"){
                        $this->transactionassesmentRepository->storeTrsAssesmentDetailthree($key,$uuid,$uuiddetail,$date);
                    }else if($findassesmentgroup->first()->type == "4"){
                        $this->transactionassesmentRepository->storeTrsAssesmentDetailfour($key,$uuid,$uuiddetail,$date);
                    }else if($findassesmentgroup->first()->type == "5"){
                        $this->transactionassesmentRepository->storeTrsAssesmentDetailfive($key,$uuid,$uuiddetail,$date);
                    }
                }

                if($findassesmentgroup->first()->type == "1"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailone($uuid);
                }else if($findassesmentgroup->first()->type == "3"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailthree($uuid);
                }else if($findassesmentgroup->first()->type == "4"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailfour($uuid);
                }else if($findassesmentgroup->first()->type == "5"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailfive($uuid);
                }
                
                $response = [
                    'header' => $data, 
                    'detail' => $detail, 
                ];

                DB::commit();
                return $this->sendResponse($response, 'Transaksi Penilaian Mahasiswa Berhasil dibuat !');

            }else{
                if($findassesmentgroup->first()->type == "1"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailone($request->id);
                }else if($findassesmentgroup->first()->type == "3"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailthree($request->id);
                }else if($findassesmentgroup->first()->type == "4"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailfour($request->id);
                }else if($findassesmentgroup->first()->type == "5"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailfive($request->id);
                }
 
                $data = [
                    'id' => $request->id,                
                    'assesmentgroupid' => $request->assesmentgroupid,
                    'studentid' => $request->studentid, 
                    'lectureid' => $request->lectureid,  
                    'yearid' => $request->yearid,  
                    'semesterid' => $request->semesterid,  
                    'specialistid' => $request->specialistid,  
                    'grandotal' => $request->grandotal,   
                    'assesmenttype' => $findassesmentgroup->first()->type,   
                    'active' => $request->active 
                ];
                $response = [
                    'header' => $data, 
                    'detail' => $detail , 
                ];

                return $this->sendResponse($response, 'Transaksi Penilaian Mahasiswa sudah ada dibuat !');
            }
            
           
           
            
           
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }

}