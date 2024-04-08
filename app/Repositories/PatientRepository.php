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
    protected $table_unit =
    [
        "46" => "emrortodonsies",
        "58" => "emrpedodonties",
        "59" => "emrperiodonties",
        "60" => "emrprostodonties",
        "137" => "emrkonservasis",
        "10" => "emrradiologies",
    ];

    public function findpatients()
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $idunit = request()->query("idunit");
        $type = request()->query("type", "active");
        $datetime_start = request()->query("start", Carbon::now()->format('Y-m-d'));
        $datetime_to = request()->query("to", Carbon::now()->format('Y-m-d'));

        $content = QueryBuilder::for(patient::class);

        if ($idunit) {

            $fix = "";

            if ($this->table_unit[$idunit] == "emrradiologies") {

                $fix = "";

            } else {

                if ($type == "active") {

                    $fix = " AND ".$this->table_unit[$idunit].".status_emr = 'OPEN'";

                } else if ($type == "history") {

                    $fix = " AND ".$this->table_unit[$idunit].".status_emr <> 'OPEN'";
                }
            }

            $content = $content->
            where("idunit", $idunit)->
            leftJoin(DB::raw("(SELECT * FROM ".$this->table_unit[$idunit]." WHERE ".$this->table_unit[$idunit].".noepisode IS NOT NULL".$fix.") AS ".$this->table_unit[$idunit]), "patients.noregistrasi", "=", $this->table_unit[$idunit].".noregister")->
            select("patients.*",
            $this->table_unit[$idunit].".id as id_emr",
            $this->table_unit[$idunit].".status_emr as status_emr",
            $this->table_unit[$idunit].".status_penilaian as status_penilaian");
        }

        $content = $content->
        whereBetween(DB::raw("CAST(visit_date as DATE)"), [ $datetime_start, $datetime_to, ]);

        $content = $content->
        defaultSort("-noepisode")->
        allowedSorts($content->getSubject()->getModel()->getFillable())->
        allowedFilters($content->getSubject()->getModel()->getFillable())->
        paginate($limit, [ "*", ], "current_page", $current_page)->appends(empty($querystring) ? request()->query() : $querystringed);

        return $content;
    }

    public function findpatientsByEmr($idunit, $nim)
    {
        $querystring = [];

        $querystringed =
        [
            "limit" => $querystring["limit"] ?? request()->query("limit", 10),
            "current_page" => $querystring["current_page"] ?? request()->query("current_page", 1),
        ];
        extract($querystringed);

        $datetime_start = request()->input("from", Carbon::now()->format('Y-m-d'));
        $datetime_to = request()->input("to", Carbon::now()->format('Y-m-d'));

        $content = QueryBuilder::for(patient::class);

        if ($idunit) {

            $content = $content->
            where("idunit", $idunit)->
            join(DB::raw("(SELECT * FROM ".$this->table_unit[$idunit]." WHERE ".$this->table_unit[$idunit].".noepisode IS NOT NULL AND ".$this->table_unit[$idunit].".nim = '".$nim."') AS ".$this->table_unit[$idunit]), "patients.noregistrasi", "=", $this->table_unit[$idunit].".noregister")->
            select("patients.*",
            $this->table_unit[$idunit].".id as id_emr",
            $this->table_unit[$idunit].".status_emr as status_emr",
            $this->table_unit[$idunit].".status_penilaian as status_penilaian");
        }

        $content = $content->
        whereBetween(DB::raw("CAST(visit_date as DATE)"), [ $datetime_start, $datetime_to, ]);

        $content = $content->
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

    public function updateStatus($data)
    {
        $result = [];

        $user = auth()->user();
        $emr = DB::table($this->table_unit[$data["idunit"]])->
        where("id", $data["id"]);

        if ($user->role == "dosen") {

            $emr->update(
            [
                "status_penilaian" => $data["status"],
            ]);

            $result = $emr->get();

        } else if ($user->role == "mahasiswa") {

            $emr->update(
            [
                "status_emr" => $data["status"],
            ]);

            $result = $emr->get();

        } else {

            $result = 0;
        }

        return $result;
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