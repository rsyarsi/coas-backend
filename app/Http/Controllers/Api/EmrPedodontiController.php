<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmrPedodontiRepository;
use App\Service\EmrPedodontiService;
use Illuminate\Http\Request;
use App\Repositories\PatientRepository;

class EmrPedodontiController extends Controller
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
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->createmedicaldentalhistory($request);
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
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
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

    // behavior rating
    public function behaviorratingcreate(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->behaviorratingcreate($request);
        return $execute;
    }
    public function behaviorratingupdate(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->behaviorratingupdate($request);
        return $execute;
    }
    public function behaviorratingdelete(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->behaviorratingdelete($request);
        return $execute;
    }
    public function behaviorratingviewbyid(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->behaviorratingviewbyid($request);
        return $execute;
    }
    public function behaviorratingviewall(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->behaviorratingviewall($request);
        return $execute;
    }
    // behavior rating
    // treatment
    public function treatmentcreate(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentcreate($request);
        return $execute;
    }
    public function treatmentupdate(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentupdate($request);
        return $execute;
    }
    public function treatmentdelete(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentdelete($request);
        return $execute;
    }
    public function treatmentviewbyid(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentviewbyid($request);
        return $execute;
    }
    public function treatmentviewall(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentviewall($request);
        return $execute;
    }
    public function validatesupervisor(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->validatesupervisor($request);
        return $execute;
    }
    //treatment
    // treatmentplan
    public function treatmentplancreate(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentplancreate($request);
        return $execute;
    }
    public function treatmentplanupdate(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentplanupdate($request);
        return $execute;
    }
    public function treatmentplandelete(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentplandelete($request);
        return $execute;
    }
    public function treatmentplanviewbyid(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentplanviewbyid($request);
        return $execute;
    } 
    public function treatmentplanviewall(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->treatmentplanviewall($request);
        return $execute;
    }
    //treatment plan
    public function uploadfoto(Request $request)
    {
        //
        $yearRepository =  new EmrPedodontiRepository();
        $patientService = new PatientRepository;
        $aReturBeliService = new EmrPedodontiService(
            $yearRepository,
            $patientService
        );
        $execute =  $aReturBeliService->uploadfoto($request);
        return $execute;
    }
}