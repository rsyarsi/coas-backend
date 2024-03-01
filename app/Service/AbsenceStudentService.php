<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AbsenceStudentRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\Interfaces\AssesmentGroupRepositoryInterface;
use App\Repositories\Interfaces\AssesmentDetailRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;

class AbsenceStudentService extends Controller
{
    private $StudentRepository;    
    private $AbsenceStudentRepository;


    public function __construct(
        StudentRepositoryInterface $StudentRepository,        
        AbsenceStudentRepositoryInterface $AbsenceStudentRepository
        )
    {
        $this->StudentRepository = $StudentRepository;        
        $this->AbsenceStudentRepository = $AbsenceStudentRepository;

    }
    public function storeData(Request $request)
    {
        // validate 
        $request->validate([ 
            "studentid" => "required",  
            "statusabsensi" => "required"
        ]);
        
        try {

            // Db Transaction
            DB::beginTransaction(); 
            $findassesmentgroup = $this->StudentRepository->findStudent($request->studentid);
            if($findassesmentgroup->count() < 1){
                return $this->sendError('ID Mahasiswa tidak ditemukan !', []);
            }

            // validate kode sub
          
            if($request->kodesub > 0 and $request->index_sub < 1){
                return $this->sendError('Kode Sub sudah terisi, Kode Index sub harus lebih besar dari 0 !', []);
            }
            if($request->statusabsensi == "" || $request->statusabsensi == ""){
                return$this->sendError("Status Absensi Kosong.",[]);
            }

            if($request->id == "" || $request == null){
                $uuid = Uuid::uuid4();            
                
                if($request->statusabsensi == "IN"){
                    $data = [
                        'id' => $uuid,                
                        'studentid' => $request->studentid,
                        'statusabsensi' => $request->statusabsensi,
                        'time_in' => Carbon::now(),
                        'periode' => Carbon::now()->format("Y-m"),
                        'date' => Carbon::now()->format("Y-m-d")
                    ];
                }elseif ($request->statusabsensi == "OUT"){
                    $data = [
                        'id' => $uuid,                
                        'studentid' => $request->studentid,
                        'statusabsensi' => $request->statusabsensi,
                        'time_out' => Carbon::now(),
                        'periode' => Carbon::now()->format("Y-m"),
                        'date' => Carbon::now()->format("Y-m-d")
                    ];
                }
                $execute = $this->AbsenceStudentRepository->storeAbsenceStudent($data,$uuid);    
            }else{
                
                if($request->statusabsensi == "IN"){
                    $data = [
                        'id' => $request->id,                
                        'studentid' => $request->studentid,
                        'statusabsensi' => $request->statusabsensi,
                        'time_in' => Carbon::now(), 
                        'periode' => Carbon::now()->format("Y-m"),
                        'date' => Carbon::now()->format("Y-m-d")
                    ];
             
                    $execute = $this->AbsenceStudentRepository->updateAbsenceStudentIn($data);
                    
                }elseif($request->statusabsensi == "OUT"){
                    $data = [
                        'id' => $request->id,                
                        'studentid' => $request->studentid,
                        'statusabsensi' => $request->statusabsensi, 
                        'time_out' => Carbon::now(),
                        'periode' => Carbon::now()->format("Y-m"),
                        'date' => Carbon::now()->format("Y-m-d")
                    ];
                    $execute = $this->AbsenceStudentRepository->updateAbsenceStudentOut($data);
                }

            }
            DB::commit();

            if($execute){
                return $this->sendResponse($data, 'Absensi Berhasil dibuat !');
            }
            

        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
    
    public function findbydate(Request $request)
    {
        try {
            $find = $this->AbsenceStudentRepository->findbydate($request);
             
            if($find->count() < 1){
                return $this->sendError('Data Absensi tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Data Absensi ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function reportmonthbystudent(Request $request)
    {
        try {
            $find = $this->AbsenceStudentRepository->absenceperiodemonth($request);
             
            if($find->count() < 1){
                return $this->sendError('Data Absensi tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Data Absensi ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}