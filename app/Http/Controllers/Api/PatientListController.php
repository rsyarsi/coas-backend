<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PatientRepository;
use App\Service\PatientService;
use Illuminate\Http\Request;
use App\Repositories\SpecialistRepository;
use App\Repositories\StudentRepository;

class PatientListController extends Controller
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

    public function updateStatus(Request $request)
    {
        $repository = new PatientRepository;

        $specialistRepository = new SpecialistRepository(); 
        $studentRepository = new StudentRepository();

        $services = new PatientService($specialistRepository, $repository, $studentRepository);
        $execute = $services->updateStatus($request);

        return $execute;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //
        $repo = new PatientRepository;
        $SpecialistRepository =  new SpecialistRepository(); 
        $studentRepository = new StudentRepository();
        $services = new PatientService($SpecialistRepository,$repo,$studentRepository);
        $execute =  $services->listksmgigi();
        return $execute;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request)
    {
        //
        $repo = new PatientRepository;
        $SpecialistRepository =  new SpecialistRepository(); 
        $studentRepository = new StudentRepository();
        $services = new PatientService($SpecialistRepository,$repo,$studentRepository);
        $execute =  $services->detail($request);
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
        $repo = new PatientRepository;
        $SpecialistRepository =  new SpecialistRepository(); 
        $studentRepository = new StudentRepository();
        $services = new PatientService($SpecialistRepository,$repo,$studentRepository);
        $execute =  $services->listksmgigihistory($request);
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

    // public function bySpecialistAndNim($idspecialist,$nim)
    // {
    //     $repo = new PatientRepository;
    //     $SpecialistRepository =  new SpecialistRepository(); 
    //     $services = new PatientService($SpecialistRepository,$repo);
    //     $execute =  $services->listbyspecialistandnim($idspecialist,$nim);
    //     return $execute;
    // }

    public function bystudent(Request $request)
    {
        $repo = new PatientRepository;
        $SpecialistRepository =  new SpecialistRepository(); 
        $studentRepository = new StudentRepository();
        $services = new PatientService($SpecialistRepository,$repo,$studentRepository);
        $execute =  $services->bystudent($request);
        return $execute;
    }
}
