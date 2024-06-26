<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AbsenceStudentRepository;
use App\Repositories\StudentRepository;
use App\Service\AbsenceStudentService;
use Illuminate\Http\Request;

class AbsenceStudentController extends Controller
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
        $studentRepository =  new StudentRepository(); 
        $AbsenceStudentRepository =  new AbsenceStudentRepository(); 
        $Service = new AbsenceStudentService(
            $studentRepository,
            $AbsenceStudentRepository 
        );
        $execute =  $Service->storeData($request);
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
        $studentRepository =  new StudentRepository(); 
        $AbsenceStudentRepository =  new AbsenceStudentRepository(); 
        $Service = new AbsenceStudentService(
            $studentRepository,
            $AbsenceStudentRepository 
        );
        $execute =  $Service->findbydate($request);
        return $execute;
    }
    public function reportmonthbystudent(Request $request)
    {
        //
        $studentRepository =  new StudentRepository(); 
        $AbsenceStudentRepository =  new AbsenceStudentRepository(); 
        $Service = new AbsenceStudentService(
            $studentRepository,
            $AbsenceStudentRepository 
        );
        $execute =  $Service->reportmonthbystudent($request);
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
}
