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
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(patient::class);

        $content = $content->
        whereBetween(DB::raw("CAST(Visit_Date as DATE)"), [ Carbon::now()->format('Y-m-d'), Carbon::now()->format('Y-m-d'), ])->
        defaultSort("-noepisode")->
        allowedSorts($content->getSubject()->getModel()->getFillable())->
        allowedFilters($content->getSubject()->getModel()->getFillable())->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
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

    public function listByEmrAndNimOrto($nim)
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(patient::class);

        $content = $content->
        join("emrortodonsies", "emrortodonsies.noregister", "=", "patients.noregistrasi")->
        where("emrortodonsies.nim", $nim)->
        // defaultSort("-noepisode")->
        allowedSorts($content->getSubject()->getModel()->getFillable())->
        allowedFilters($content->getSubject()->getModel()->getFillable())->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function listByEmrAndNimPedo($nim)
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(patient::class);

        $content = $content->
        join("emrpedodonties", "emrpedodonties.noregister", "=", "patients.noregistrasi")->
        where("emrpedodonties.nim", $nim)->
        // defaultSort("-noepisode")->
        allowedSorts($content->getSubject()->getModel()->getFillable())->
        allowedFilters($content->getSubject()->getModel()->getFillable())->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function listByEmrAndNimPerio($nim)
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(patient::class);

        $content = $content->
        join("emrperiodonties", "emrperiodonties.noregister", "=", "patients.noregistrasi")->
        where("emrperiodonties.npm", $nim)->
        // defaultSort("-noepisode")->
        allowedSorts($content->getSubject()->getModel()->getFillable())->
        allowedFilters($content->getSubject()->getModel()->getFillable())->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function listByEmrAndNimProsto($nim)
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(patient::class);

        $content = $content->
        join("emrprostodonties", "emrprostodonties.noregister", "=", "patients.noregistrasi")->
        where("emrprostodonties.npm", $nim)->
        // defaultSort("-noepisode")->
        allowedSorts($content->getSubject()->getModel()->getFillable())->
        allowedFilters($content->getSubject()->getModel()->getFillable())->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
    public function listByEmrAndNimKonser($nim)
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $content = QueryBuilder::for(patient::class);

        $content = $content->
        join("emrkonservasis", "emrkonservasis.noregister", "=", "patients.noregistrasi")->
        where("emrkonservasis.nim", $nim)->
        // defaultSort("-noepisode")->
        allowedSorts($content->getSubject()->getModel()->getFillable())->
        allowedFilters($content->getSubject()->getModel()->getFillable())->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }
}