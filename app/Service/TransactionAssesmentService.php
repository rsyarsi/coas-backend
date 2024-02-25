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
            if($request->id <> ""){
                $findtrsassesmentbyId  = $this->transactionassesmentRepository->findtrsassesmentbyidandGroupId($request);
                if($findtrsassesmentbyId->count() < 1){
                    return $this->sendError('Group Penilaian pada Nomor Transaksi Penilaian ini tidak ditemukan, silahkan check kembali data Nomor transaksi dan Group Penilaian anda !', []);
                }
            }
            $verify = $this->transactionassesmentRepository->verifyTrsAssesment($request,$findassesmentgroup->first()->type);
       
            $dataspesialis = $findgroupspecialist->first();
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
                    'idspecialistsimrs' => $dataspesialis->simrsid,                       
                    'transactiondate' => $request->transactiondate,    
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
                    }else if($findassesmentgroup->first()->type == "6"){
                        $this->transactionassesmentRepository->storeTrsAssesmentDetailoneControl($key,$uuid,$uuiddetail,$date);
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
                }else if($findassesmentgroup->first()->type == "6"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailoneControl($uuid);
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
                }else if($findassesmentgroup->first()->type == "6"){
                    $detail = $this->transactionassesmentRepository->findTrsAssesmentDetailoneControl($request->id);
                }
                $idTransaksiPenilaian = $verify->first()->id;
                $data = [
                    'id' => $idTransaksiPenilaian,                
                    'assesmentgroupid' => $request->assesmentgroupid,
                    'studentid' => $request->studentid, 
                    'lectureid' => $request->lectureid,  
                    'yearid' => $request->yearid,  
                    'semesterid' => $request->semesterid,  
                    'idspecialistsimrs' => $dataspesialis->simrsid,      
                    'specialistid' => $request->specialistid,  
                    'grandotal' => $request->grandotal,   
                    'assesmenttype' => $findassesmentgroup->first()->type,   
                    'active' => $request->active 
                ];
                $response = [
                    'header' => $data,                    
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
    public function updateDetail(Request $request)
    {
        // validate 
        $request->validate([ 
            "id" => "required", 
            "dateupdate" => "required", 
            "assesmentgroupid" => "required",  
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findtrsbyid = $this->transactionassesmentRepository->findtrsbyid($request);
            if($findtrsbyid->count() < 1){
                return $this->sendError('No. Transaksi Penilaian tidak di temukan !', []);
            }

            $findassesmentgroup = $this->groupAssesmentRepository->findAssesmentGroup($request->assesmentgroupid);
            if($findassesmentgroup->count() < 1){
                return $this->sendError('Assesment group tidak di temukan !', []);
            }


            // validasi row id 
            foreach ($request->data as $key  ) {
                # code...
               
                if($findassesmentgroup->first()->type == "1"){
                    $datadetail1 = $this->transactionassesmentRepository->findTrsAssesmentDetailonebyId($key['iddetail']);
                    if($datadetail1->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                }else if($findassesmentgroup->first()->type == "3"){
                    $datadetail3 = $this->transactionassesmentRepository->findTrsAssesmentDetailthreebyId($key['iddetail']);
                    if($datadetail3->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                }else if($findassesmentgroup->first()->type == "4"){
                    $datadetail4 = $this->transactionassesmentRepository->findTrsAssesmentDetailfourbyId($key['iddetail']);
                    if($datadetail4->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                }else if($findassesmentgroup->first()->type == "5"){
                    $datadetail5 = $this->transactionassesmentRepository->findTrsAssesmentDetailfivebyId($key['iddetail']);
                    if($datadetail5->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                } 
            }

            /// update data 
            foreach ($request->data as $key  ) {
                # code...
               
                if($findassesmentgroup->first()->type == "1"){
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailone($key);
                }else if($findassesmentgroup->first()->type == "3"){
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailthree($key);
                }else if($findassesmentgroup->first()->type == "4"){
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailfour($key);
                }else if($findassesmentgroup->first()->type == "5"){
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailfive($key);
                } 
            }

            // update header
            $sumdata = $this->transactionassesmentRepository->sumTrsAssesmentDetailonebyIdTransaksiHeader($request->id);
            $this->transactionassesmentRepository->updateTrsAssesmentHeader($request->id,$sumdata);
       
            DB::commit();
            return $this->sendResponse([], 'Transaksi Penilaian Mahasiswa detail berhasil disimpan !');
        }catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function showdetail(Request $request)
    {
        // validate 
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findtrsbyid = $this->transactionassesmentRepository->findtrsbyid($request);
            if($findtrsbyid->count() < 1){
                return $this->sendError('No. Transaksi Penilaian tidak di temukan !', []);
            }
            $assesmentgroup = $findtrsbyid->first()->assesmentgroupid;
            $findassesmentgroup = $this->groupAssesmentRepository->findAssesmentGroup($assesmentgroup);
            if($findassesmentgroup->count() < 1){
                return $this->sendError('Assesment group tidak di temukan !', []);
            }
                if($findassesmentgroup->first()->type == "1"){
                    $datadetail = $this->transactionassesmentRepository->findFilledTrsAssesmentDetailonebyId($request->id);
                }else if($findassesmentgroup->first()->type == "3"){
                    $datadetail = $this->transactionassesmentRepository->findFilledTrsAssesmentDetailthreebyId($request->id);
                }else if($findassesmentgroup->first()->type == "4"){
                    $datadetail = $this->transactionassesmentRepository->findFilledTrsAssesmentDetailfourbyId($request->id);
                }else if($findassesmentgroup->first()->type == "5"){
                    $datadetail = $this->transactionassesmentRepository->findFilledTrsAssesmentDetailfivebyId($request->id);
                } 
           
            // update header totalbobot
            $this->transactionassesmentRepository->updateTrsAssesmentHeaderTotalBobot($request,$findassesmentgroup->first()->valuetotal);
       
            DB::commit();
            return $this->sendResponse($datadetail, 'Transaksi Penilaian Mahasiswa detail ditemukan !');

        }catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function viewtrsassesmentheaderbyid(Request $request)
    {
        // validate 
        $request->validate([ 
            "id" => "required",  
        ]);
        
        try {

            // Db Transaction
    
            $findtrsbyid = $this->transactionassesmentRepository->viewtrsassesmentheaderbyid($request);
            if($findtrsbyid->count() < 1){
                return $this->sendError('No. Transaksi Penilaian tidak di temukan !', []);
            }
            
            return $this->sendResponse($findtrsbyid->first(), 'Data Penilaian ditemukan !');

        }catch (Exception $e) {
 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function viewtrsassesmentdetalbyidandtype(Request $request)
    {
        // validate 
        $request->validate([ 
            "id" => "required",            
            "type" => "required", 
        ]);
        
        try {

            // Db Transaction

                if($request->type == "1"){
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailonebyId($request->id);
                }else if($request->type == "3"){
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailthreebyId($request->id);
                }else if($request->type == "4"){
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailfourbyId($request->id);
                }else if($request->type == "5"){
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailfivebyId($request->id);
                } 
            
            return $this->sendResponse($datadetail->first(), 'Data Penilaian detail ditemukan !');

        }catch (Exception $e) {
 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
    public function updatedetailsbyitem(Request $request)
    {
        // validate 
        $request->validate([ 
            "id" => "required",  
            "idhdr" => "required",  
            "assesmenttype" => "required",  
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
        
                if($request->kodesub > "0" ){
                    return $this->sendError('Sub Group Penilaian tidak bisa diisikan nilai !', []);
                }
                if($request->assesmenttype == "1"){
                    $datadetail1 = $this->transactionassesmentRepository->findTrsAssesmentDetailonebyId($request->id);
                    if($datadetail1->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                }else if($request->assesmenttype == "3"){
                    $datadetail3 = $this->transactionassesmentRepository->findTrsAssesmentDetailthreebyId($request->id);
                    if($datadetail3->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                }else if($request->assesmenttype == "4"){
                    $datadetail4 = $this->transactionassesmentRepository->findTrsAssesmentDetailfourbyId($request->id);
                    if($datadetail4->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                }else if($request->assesmenttype == "5"){
                    $datadetail5 = $this->transactionassesmentRepository->findTrsAssesmentDetailfivebyId($request->id);
                    if($datadetail5->count() < 1){
                        return $this->sendError('Assesment Detail tidak ditemukan !', []);
                    }
                } 
        
                if($request->assesmenttype == "1"){

                    if($request->assementvalue > $request->assesmentbobotvalue){
                        return $this->sendError('Nilai yang anda masukan melebihi Bobot Nilai !', []);
                    } 
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailoneSingle($request);
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailonebyId($request->id)->first();
                }else if($$request->assesmenttype == "3"){
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailthreeSingle($request);
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailthreebyId($request->id)->first();
                }else if($$request->assesmenttype == "4"){
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailfourSingle($request);
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailfourbyId($request->id)->first();
                }else if($$request->assesmenttype == "5"){
                    $this->transactionassesmentRepository->updateTrsAssesmentDetailfiveSingle($request);
                    $datadetail = $this->transactionassesmentRepository->findFillednoPagingTrsAssesmentDetailfivebyId($request->id)->first();
                } 
                
            // updatesub
            $sumdata = $this->transactionassesmentRepository->sumTrsAssesmentDetailonebyIdTransaksiSub($request);
            $this->transactionassesmentRepository->updateTrsAssesmentsub($request,$sumdata);

            // update header
            $sumdata = $this->transactionassesmentRepository->sumTrsAssesmentDetailonebyIdTransaksiHeader($request->idhdr);
            $this->transactionassesmentRepository->updateTrsAssesmentHeader($request->idhdr,$sumdata);


            $response = [
                'id' => $request->id,  
            ];

            DB::commit();
            return $this->sendResponse($datadetail, 'Transaksi Penilaian Mahasiswa detail berhasil disimpan !');
        }catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}