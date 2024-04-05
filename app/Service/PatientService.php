<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Repositories\Interfaces\semesterRepositoryInterface;
use App\Repositories\Interfaces\SpecialistRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Traits\ApiConsume;

class PatientService extends Controller
{ 
    use ApiConsume;
    private $patientRepository;
    private $studentRepository;

    public function __construct(
        SpecialistRepositoryInterface $SpecialistRepository,
        PatientRepositoryInterface $patientRepository,
        StudentRepository $studentRepository,
        )
    {
        $this->SpecialistRepository = $SpecialistRepository;
        $this->patientRepository = $patientRepository;
        $this->studentRepository = $studentRepository; 
    }
    public function listksmgigi()
    {
        try {
 
            $list =  $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "registrations/getRegistrationRajalActiveCoas",
                "POST",
                json_encode([
                    'tglPeriodeBerobatAwal' => Carbon::now()->format('Y-m-d'),
                    'tglPeriodeBerobatAkhir' =>  Carbon::now()->format('Y-m-d'),
                ]) 
            );
       
            foreach ($list['data'] as $key  ) {
                # code...
                
                $cek = $this->patientRepository->findbyNoregistrasi($key['NoRegistrasi']);
               
                if($cek->count() < 1){
                    $this->patientRepository->storePatient($key);

                }
                
            }

            $datalistreg = $this->patientRepository->findpatients();
            return $this->sendResponse($datalistreg, 'Data Pasien ditemukan !');
             
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function listksmgigihistory($request)
    {
        try {
            $data =  $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "registrations/getRegistrationRajalHistoryCoas",
                "POST",
                json_encode([
                    'tglPeriodeBerobatAwal' => $request->tglAwal,
                    'tglPeriodeBerobatAkhir' => $request->tglAkhir,
                ]) 
            );
            return $this->sendResponse($data, 'Data ditemukan !');
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function detail($request)
    {
        try {
            return $this->GuzzleClientRequestPost(
                env('API_URL_YARSI') . "registrations/viewByNoregistrasi",
                "POST",
                json_encode([ 
                    'NoRegistrasi' => $request
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
    public function bystudent($request)
    {
        try {
            $findgroupspecialist = $this->SpecialistRepository->findSpecialist($request->specialistid);
            if($findgroupspecialist->count() < 1){
                return $this->sendError('Specialist tidak di temukan !', []);
            }
            $findstudent = $this->studentRepository->findStudent($request->studentid);
            if($findstudent->count() < 1){
                return $this->sendError('Mahasiswa tidak di temukan !', []);
            }
            $nim = $findstudent->first()->nim;

            $unitsimrsid = $findgroupspecialist->first()->simrsid;

            if ($unitsimrsid == '46'){
                //ortodonti
                 $find = $this->patientRepository->listByEmrAndNimOrto($nim);
            }elseif($unitsimrsid == '58'){
                //pedodonti
                 $find = $this->patientRepository->listByEmrAndNimPedo($nim);
            }elseif($unitsimrsid == '59'){
                //periodonti
                 $find = $this->patientRepository->listByEmrAndNimPerio($nim);
            }elseif($unitsimrsid == '60'){
                //prostodonti
                 $find = $this->patientRepository->listByEmrAndNimProsto($nim);
            }elseif($unitsimrsid == '137'){
                //konservasi
                 $find = $this->patientRepository->listByEmrAndNimKonser($nim);
            }else{
                return $this->sendError('Data tidak ditemukan !',[]);
            }
             
            if($find->count() < 1){
                return $this->sendError('Data tidak ditemukan !',[]);
            }
            return $this->sendResponse($find, 'Data ditemukan !');
        } catch (Exception $e) { 
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }

    public function updateStatusEmrFinish(Request $request)
    {
        $request->validate([ 
            "noregister" => "required",   
        ]);
      
        try {    
            DB::beginTransaction();
            $cekdata = $this->patientRepository->findbyNoregistrasi($request->noregister);

            if ($cekdata->count() < 1){
                return $this->sendError('Data tidak ditemukan !',[]);
            }
           
            //update status_emr to finish
            $this->patientRepository->updateStatusEmrFinish($request->noregister);
            
            DB::commit();
            return $this->sendResponse([], 'Status berhasil diperbarui menjadi FINISH');
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }

    }
}