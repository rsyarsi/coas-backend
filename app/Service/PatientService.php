<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller; 
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Repositories\Interfaces\semesterRepositoryInterface;
use App\Traits\ApiConsume;

class PatientService extends Controller
{ 
    use ApiConsume;
    public function listksmgigi()
    {
        try {
            return $this->GuzzleClientRequest(
                env('API_URL_YARSI') . "registrations/getRegistrationRajalActiveCoas",
                "GET" 
            );
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
                    'NoRegistrasi' => $request->NoRegistrasi
                ])
            );
        } catch (\Exception $e) {
            throw new HttpException(200, $e);
        }
    }
}