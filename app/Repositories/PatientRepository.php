<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\patient;
use App\Models\Semester;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\SemesterRepositoryInterface;
use Tripteki\RequestResponseQuery\QueryBuilder;

class PatientRepository implements PatientRepositoryInterface
{
    public function findpatients()
    {
        return patient::orderBy('noepisode', 'DESC')->latest()
        ->whereBetween(DB::raw("CAST(Visit_Date as DATE)"),
        [Carbon::now()->format('Y-m-d'),Carbon::now()->format('Y-m-d')])->paginate(10);
    }
    public function listksmgigiwithoutpaging()
    {
        return patient::all();
    }

    public function storePatient($request)
    {
        // return  DB::table("patients")->insert($request);

        return  patient::insert([
            'noepisode'=> $request['NoEpisode'],
            'noregistrasi'=> $request['NoRegistrasi'],        
            'nomr'=> $request['NoMR'],
            'patientname'=> $request['PatientName'],        
            'namajaminan'=> $request['NamaJaminan'],
            'noantrianall'=> $request['NoAntrianAll'],
            'gander'=> $request['Gander'],
            'date_of_birth'=> $request['Date_of_birth'],
            'address'=> $request['Address'],
            'idunit'=> $request['IdUnit'],
            'visit_date'=> $request['Visit_Date'],        
            'namaunit'=> $request['NamaUnit'],
            'iddokter'=> $request['IdDokter'],
            'namadokter'=> $request['NamaDokter'],
            'patienttype'=> $request['PatientType'],
            'statusid'=> $request['StatusID'],
            'status_emr'=> 'OPEN',
            'status_penilaian'=> 'OPEN'

        ]);

    }

    public function findbyNoregistrasi($id)
    {
        return patient::where('noregistrasi',$id)->get();
    }

    public function listByEmrAndNimOrto($nim)
    {
        $query =  DB::table('patients')
        ->select('patients.*')
        ->join('emrortodonsies','emrortodonsies.noregister','=','patients.noregistrasi')
        ->where('emrortodonsies.nim',$nim)
        ->paginate();
        return $query;
    }
    public function listByEmrAndNimPedo($nim)
    {
        $query =  DB::table('patients')
        ->select('patients.*')
        ->join('emrpedodonties','emrpedodonties.noregister','=','patients.noregistrasi')
        ->where('emrpedodonties.nim',$nim)
        ->paginate();
        return $query;
    }
    public function listByEmrAndNimPerio($nim)
    {
        $query =  DB::table('patients')
        ->select('patients.*')
        ->join('emrperiodonties','emrperiodonties.noregister','=','patients.noregistrasi')
        ->where('emrperiodonties.npm',$nim)
        ->paginate();
        return $query;
    }
    public function listByEmrAndNimProsto($nim)
    {
        $query =  DB::table('patients')
        ->select('patients.*')
        ->join('emrprostodonties','emrprostodonties.noregister','=','patients.noregistrasi')
        ->where('emrprostodonties.npm',$nim)
        ->paginate();
        return $query;
    }
    public function listByEmrAndNimKonser($nim)
    {
        $query =  DB::table('patients')
        ->select('patients.*')
        ->join('emrkonservasis','emrkonservasis.noregister','=','patients.noregistrasi')
        ->where('emrkonservasis.nim',$nim)
        ->paginate();
        return $query;
    }
    public function updateStatusEmrWrite($noregistrasi)
    { 
        $updates = DB::table('patients')
        ->where('noregistrasi', $noregistrasi)
        ->where('status_emr','<>','FINISH')
        ->update([ 
            'status_emr' => 'WRITE',
        ]);
        return $updates;
    }
    public function updateStatusEmrFinish($noregistrasi)
    { 
        $updates = DB::table('patients')
        ->where('noregistrasi', $noregistrasi)
        ->update([ 
            'status_emr' => 'FINISH',
        ]);
        return $updates;
    }
}