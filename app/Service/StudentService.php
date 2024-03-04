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
use App\Repositories\UserRepository;

class StudentService extends Controller
{
    private $SpecialistRepository;
    private $lectureRepository;
    private $semesterRepository;
    private $universityRepository;
    private $hospitalRepository;
    private $studentRepository;
    private $userRepository;


    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        LectureRepositoryInterface $lectureRepository,
        SemesterRepository $semesterRepository,
        UniversityRepository $universityRepository,
        HospitalRepository $hospitalRepository,
        StudentRepository $studentRepository,
        UserRepository $userRepository
        
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->lectureRepository = $lectureRepository;
        $this->semesterRepository = $semesterRepository;
        $this->universityRepository = $universityRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->studentRepository = $studentRepository; 
        $this->userRepository = $userRepository; 
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

            $findStudentbyNIM = $this->studentRepository->findStudentbyNIM($request->nim);
            if($findStudentbyNIM->count() > 0) {
                return $this->sendError('NIM atas Mahasiswa ini sudah ada !', []);
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
            if($execute){
                $uuidx = Uuid::uuid4();
                $dataUser = [
                    'id' => $uuidx,                
                    'username' => $request->nim,
                    'email' => "-", 
                    'name' => $request->name,
                    'role' => "mahasiswa", 
                    'password'  => bcrypt('123456')
                ];
                $this->userRepository->storeUser($dataUser,$uuidx);
            }
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
    public function nim($id)
    {
        try {
            
            $find = $this->studentRepository->findStudentnim($id); 
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
    public function viewallwithotpaging()
    {
        try {
            $find = $this->studentRepository->viewallwithotpaging();
             
            if($find->count() < 1){
                return $this->sendError('Data Mahasiswa tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Mahasiswa ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function byspecialist($id)
    {
        try {
            
            $find = $this->studentRepository->findStudentbyspecialist($id); 
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