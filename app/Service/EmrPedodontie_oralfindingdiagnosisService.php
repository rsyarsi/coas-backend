<?php

namespace App\Service;

use Exception;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\EmrPedodontie_oralfindingdiagnosisRepositoryInterface;
use App\Repositories\Interfaces\HospitalRepositoryInterface;

class EmrPedodontie_oralfindingdiagnosisService extends Controller
{
    private $EmrPedodontie_oralfindingdiagnosisRepository;

    public function __construct(EmrPedodontie_oralfindingdiagnosisRepositoryInterface $EmrPedodontie_oralfindingdiagnosisRepository)
    {
        $this->EmrPedodontie_oralfindingdiagnosisRepository = $EmrPedodontie_oralfindingdiagnosisRepository;
    }
    public function createmedicaldentalhistory(Request $request)
    {
        // validate 
        $request->validate([
            "emrid" => "required",
            "oralfinding" => "required",
            "diagnosis" => "required",
            "treatmentplan" => "required"
        ]);

        try {

            // Db Transaction
            DB::beginTransaction();
            $uuid = Uuid::uuid4();
            $data = [
                'id' => $uuid,
                'emrid' => $request->emrid,
                'oralfinding' => $request->oralfinding,
                'diagnosis' => $request->diagnosis,
                'treatmentplan' => $request->treatmentplan
            ];
            $cekdata = $this->EmrPedodontie_oralfindingdiagnosisRepository->findmedicaldentalhistory($request);

            if ($cekdata->count() < 1) {
                $execute = $this->EmrPedodontie_oralfindingdiagnosisRepository->createmedicaldentalhistory($data, $uuid);
                $message = 'Assesment Pedodonti Berhasil Dibuat !';
            } else {
                $execute = $this->EmrPedodontie_oralfindingdiagnosisRepository->updatemedicaldentalhistory($request);
                $message = 'Assesment Pedodonti Berhasil Diperbarui !';
            }

            DB::commit();
            if ($execute) {
                return $this->sendResponse($data, $message);
            }

            // if ($cekdata->count() < 1) {
            //     $execute = $this->emrpedodontiRepository->createmedicaldentalhistory($data, $uuid);
            // } else {
            //     $execute = $this->emrpedodontiRepository->updatemedicaldentalhistory($request);
            // }

            // DB::commit();
            // if ($execute) {
            //     return $this->sendResponse($data, 'Assesment Pedodonti Berhasil Dibuat !');
            // } else {
            //     $execute = $this->emrpedodontiRepository->updatemedicaldentalhistory($request);
            //     $message = 'Assesment Pedodonti Berhasil Diperbarui !';
            // }
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return $this->sendError('Data Transaksi Gagal Di Proses !', $e->getMessage());
        }
    }
}
