<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmrProstodontieRepository;
use App\Service\EmrProstodontieService;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;

class EmrProstodontieController extends Controller
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
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrProstodontieService($repo,$patientService);
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
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository; 
        $aReturBeliService = new EmrProstodontieService(
            $repo,
            $patientService
        );
        $execute =  $aReturBeliService->viewemrbyRegOperator($request);
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
    public function uploadfoto(Request $request)
    {
        //
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository; 
        $aReturBeliService = new EmrProstodontieService(
            $repo,
            $patientService
        );
        $execute =  $aReturBeliService->uploadfoto($request);
        return $execute;
    }
    //logbook
    public function logbookcreate(Request $request)
    {
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrProstodontieService($repo,$patientService);
        $execute =  $services->logbookcreate($request);
        return $execute;
    }
    public function logbookupdate(Request $request)
    {
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrProstodontieService($repo,$patientService);
        $execute =  $services->logbookupdate($request);
        return $execute;
    }
    public function logbookdelete(Request $request)
    {
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrProstodontieService($repo,$patientService);
        $execute =  $services->logbookdelete($request);
        return $execute;
    }
    public function logbookviewbyid(Request $request)
    {
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrProstodontieService($repo,$patientService);
        $execute =  $services->logbookviewbyid($request);
        return $execute;
    }
    public function logbookviewall(Request $request)
    {
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrProstodontieService($repo,$patientService);
        $execute =  $services->logbookviewall($request);
        return $execute;
    }
    public function validatelecture(Request $request)
    {
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository;
        $services = new EmrProstodontieService($repo,$patientService);
        $execute =  $services->validatelecture($request);
        return $execute;
    }
    public function uploadodontogram(Request $request)
    {
        //
        $repo =  new EmrProstodontieRepository();
        $patientService = new PatientRepository; 
        $aReturBeliService = new EmrProstodontieService(
            $repo,
            $patientService
        );
        $execute =  $aReturBeliService->uploadodontogram($request);
        return $execute;
    }
}
