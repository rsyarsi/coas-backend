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
use App\Traits\ApiConsume;

class PatientService extends Controller
{ 
    use ApiConsume;
    private $patientRepository;

    public function __construct(PatientRepositoryInterface $patientRepository)
    {
        $this->patientRepository = $patientRepository;
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
}