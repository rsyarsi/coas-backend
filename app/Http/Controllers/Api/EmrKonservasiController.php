<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmrKonservasiRepository;
use App\Service\EmrKonservasiService;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;

class EmrKonservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->createwaktuperawatan($request);
        return $execute;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->viewemrbyRegOperator($request);
        return $execute;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //soap
    public function createjobs(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->createjob($request);
        return $execute;
    }
    public function updatejobs(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->updatejob($request);
        return $execute;
    }
    public function deletejobs(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->deletejob($request);
        return $execute;
    }
    public function showbyidjobs(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->showbyidjob($request);
        return $execute;
    }
    public function showalljobs(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->showalljob($request);
        return $execute;
    }
    public function verifydpk(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->verifydpk($request);
        return $execute;
    }
    public function uploadrestorasibefore(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->uploadrestorasibefore($request);
        return $execute;
    }
    public function uploadrestorasiafter(Request $request)
    {
        //
        $repo =  new EmrKonservasiRepository();
        $patientService = new PatientRepository;
        $services = new EmrKonservasiService($repo,$patientService);
        $execute =  $services->uploadrestorasiafter($request);
        return $execute;
    }
}
