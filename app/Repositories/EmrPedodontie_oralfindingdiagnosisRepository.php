<?php

namespace App\Repositories;

use App\Models\emrpedodontie;
use App\Models\hospital;
use App\Models\Year;
use App\Repositories\Interfaces\EmrPedodontie_oralfindingdiagnosisRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\HospitalRepositoryInterface;

class EmrPedodontie_oralfindingdiagnosisRepository implements EmrPedodontie_oralfindingdiagnosisRepositoryInterface
{
    public function createmedicaldentalhistory($request, $uuid)
    {
        return  DB::table("emrpedodontie_oralfindingdiagnosis")->insert($request);
    }
    public function findmedicaldentalhistory($data)
    {
        return emrpedodontie_oralfindingdiagnosis::where('id', $data->id)->get();
    }
    public function updatemedicaldentalhistory($data)
    {

        $updates = emrpedodontie_oralfindingdiagnosis::where('id', $data->id)->update([
            'emrid' => $data->emrid,
            'oralfinding' => $data->oralfinding,
            'diagnosis' => $data->diagnosis,
            'treatmentplan' => $data->treatmentplan

        ]);
        return $updates;;
    }
}
