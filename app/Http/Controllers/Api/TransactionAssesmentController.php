<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Service\StudentService;
use App\Http\Controllers\Controller;
use App\Repositories\AssesmentGroupRepository;
use App\Repositories\YearRepository;
use App\Repositories\LectureRepository;
use App\Repositories\StudentRepository;
use App\Repositories\HospitalRepository;
use App\Repositories\SemesterRepository;
use App\Repositories\SpecialistRepository;
use App\Repositories\UniversityRepository;
use App\Service\TransactionAssesmentService;
use App\Repositories\TransactionAssesmentRepository;

class TransactionAssesmentController extends Controller
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
        $SpecialistRepository =  new SpecialistRepository(); 
            $LectureRepository =  new LectureRepository(); 
            $semesterRepository = new SemesterRepository();
            $universityRepository = new UniversityRepository;
            $hospitalRepository = new HospitalRepository();
            $studentRepository = new StudentRepository();
            $transactionassesmentRepository = new TransactionAssesmentRepository();
            $yearRepository = new YearRepository();
            $assesmentGroupRepository = new AssesmentGroupRepository();

            $Service = new TransactionAssesmentService(
              $SpecialistRepository,
              $LectureRepository,
              $semesterRepository, 
              $universityRepository,
              $hospitalRepository, 
              $studentRepository,
              $transactionassesmentRepository, 
              $yearRepository,
              $assesmentGroupRepository 
  
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
        $SpecialistRepository =  new SpecialistRepository(); 
            $LectureRepository =  new LectureRepository(); 
            $semesterRepository = new SemesterRepository();
            $universityRepository = new UniversityRepository;
            $hospitalRepository = new HospitalRepository();
            $studentRepository = new StudentRepository();
            $transactionassesmentRepository = new TransactionAssesmentRepository();
            $yearRepository = new YearRepository();
            $assesmentGroupRepository = new AssesmentGroupRepository();

            $Service = new TransactionAssesmentService(
              $SpecialistRepository,
              $LectureRepository,
              $semesterRepository, 
              $universityRepository,
              $hospitalRepository, 
              $studentRepository,
              $transactionassesmentRepository, 
              $yearRepository,
              $assesmentGroupRepository 
  
            );
            $execute =  $Service->updateDetail($request);
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
