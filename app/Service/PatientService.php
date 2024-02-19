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
            // return $this->GuzzleClientRequest(
            //     env('API_URL_YARSI') . "registrations/getRegistrationRajalActiveCoas",
            //     "GET" 
            // );
            $data['data'] = [
                [
                    "NoAntrianAll"=> "FE-2",
                    "NamaJaminan"=>"BPJS Kesehatan",
                    "PatientName"=>"FAKHRI FADHILLAH, TN",
                    "Gander"=>"M",
                    "Date_of_birth"=>"2009-12-15",
                    "Address"=>"JL SUMUR BATU",
                    "IdUnit"=>"46",
                    "Visit_Date"=>"2024-02-16 14:07:17.000",
                    "NamaUnit"=>"Poli Gigi Spesialis Orthodonty",
                    "IdDokter"=>"3874",
                    "NamaDokter"=>"drg. Fajar Eka Saputra, Sp.BM",
                    "NoMR"=>"07-07-24",
                    "NoEpisode"=>"OP070724-160224-0108",
                    "NoRegistrasi"=>"RJJP160224-0493",
                    "PatientType"=>"PERUSAHAAN",
                    "StatusID"=>"0"
                ],
                [
                    "NoAntrianAll"=> "FE-2",
                    "NamaJaminan"=>"BPJS Kesehatan",
                    "PatientName"=>"FAKHRI FADHILLAH, TN",
                    "Gander"=>"M",
                    "Date_of_birth"=>"2009-12-15",
                    "Address"=>"JL SUMUR BATU",
                    "IdUnit"=>"58",
                    "Visit_Date"=>"2024-02-16 14:07:17.000",
                    "NamaUnit"=>"Poli Gigi Spesialis Pedodonti",
                    "IdDokter"=>"3874",
                    "NamaDokter"=>"drg. Fajar Eka Saputra, Sp.BM",
                    "NoMR"=>"07-07-24",
                    "NoEpisode"=>"OP070724-160224-0108",
                    "NoRegistrasi"=>"RJJP160224-0493",
                    "PatientType"=>"PERUSAHAAN",
                    "StatusID"=>"0"
                ],
                [
                    "NoAntrianAll"=> "FE-2",
                    "NamaJaminan"=>"BPJS Kesehatan",
                    "PatientName"=>"FAKHRI FADHILLAH, TN",
                    "Gander"=>"M",
                    "Date_of_birth"=>"2009-12-15",
                    "Address"=>"JL SUMUR BATU",
                    "IdUnit"=>"59",
                    "Visit_Date"=>"2024-02-16 14:07:17.000",
                    "NamaUnit"=>"Poli Gigi Spesialis Periodonti",
                    "IdDokter"=>"3874",
                    "NamaDokter"=>"drg. Fajar Eka Saputra, Sp.BM",
                    "NoMR"=>"07-07-24",
                    "NoEpisode"=>"OP070724-160224-0108",
                    "NoRegistrasi"=>"RJJP160224-0493",
                    "PatientType"=>"PERUSAHAAN",
                    "StatusID"=>"0"
                ],
                [
                    "NoAntrianAll"=> "FE-2",
                    "NamaJaminan"=>"BPJS Kesehatan",
                    "PatientName"=>"FAKHRI FADHILLAH, TN",
                    "Gander"=>"M",
                    "Date_of_birth"=>"2009-12-15",
                    "Address"=>"JL SUMUR BATU",
                    "IdUnit"=>"60",
                    "Visit_Date"=>"2024-02-16 14:07:17.000",
                    "NamaUnit"=>"Poli Gigi Spesialis Prostodonti",
                    "IdDokter"=>"3874",
                    "NamaDokter"=>"drg. Fajar Eka Saputra, Sp.BM",
                    "NoMR"=>"07-07-24",
                    "NoEpisode"=>"OP070724-160224-0108",
                    "NoRegistrasi"=>"RJJP160224-0493",
                    "PatientType"=>"PERUSAHAAN",
                    "StatusID"=>"0"
                ],
                [
                    "NoAntrianAll"=> "FE-2",
                    "NamaJaminan"=>"BPJS Kesehatan",
                    "PatientName"=>"FAKHRI FADHILLAH, TN",
                    "Gander"=>"M",
                    "Date_of_birth"=>"2009-12-15",
                    "Address"=>"JL SUMUR BATU",
                    "IdUnit"=>"137",
                    "Visit_Date"=>"2024-02-16 14:07:17.000",
                    "NamaUnit"=>"Poli Gigi Spesialis Konservasi/Endodonsi",
                    "IdDokter"=>"3874",
                    "NamaDokter"=>"drg. Fajar Eka Saputra, Sp.BM",
                    "NoMR"=>"07-07-24",
                    "NoEpisode"=>"OP070724-160224-0108",
                    "NoRegistrasi"=>"RJJP160224-0493",
                    "PatientType"=>"PERUSAHAAN",
                    "StatusID"=>"0"
                ]
                ]
                ;

           return $this->sendResponse($data, 'ditemukan !');
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