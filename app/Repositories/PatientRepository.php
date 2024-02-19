<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\patient;
use App\Models\Semester;
use Illuminate\Support\Facades\DB; 
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\SemesterRepositoryInterface;

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
            'statusid'=> $request['StatusID']

        ]);

    }

    public function findbyNoregistrasi($id)
    {
        return patient::where('noregistrasi',$id)->get();
    }
}