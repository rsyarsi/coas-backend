<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmrPeriodontieRepository;
use App\Service\EmrPeriodontieService;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;

class EmrPeriodontieController extends Controller
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
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
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
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
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
        //a
    }

    public function uploadfotoklinisintraoral(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->uploadfotoklinisintraoral($request);
        return $execute;
    }
    public function uploadfotopanoramik(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->uploadfotopanoramik($request);
        return $execute;
    }


    //soap
    public function createsoap(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->createsoap($request);
        return $execute;
    }
    public function updatesoap(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->updatesoap($request);
        return $execute;
    }
    public function deletesoap(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->deletesoap($request);
        return $execute;
    }
    public function showbyidsoap(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->showbyidsoap($request);
        return $execute;
    }
    public function showallsoap(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->showallsoap($request);
        return $execute;
    }
    public function verifydpk(Request $request)
    {
        //
        $repo =  new EmrPeriodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrPeriodontieService($repo,$patientService);
        $execute =  $services->verifydpk($request);
        return $execute;
    }
}
