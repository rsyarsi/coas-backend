<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\LectureRepository;
use App\Repositories\SpecialistRepository;
use App\Repositories\UserRepository;
use App\Service\LectureService;

class LectureController extends Controller
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
          //a
          $SpecialistRepository =  new SpecialistRepository(); 
          $LectureRepository =  new LectureRepository();  
          $userRepository =  new UserRepository();  
          $Service = new LectureService(
              $SpecialistRepository,
              $LectureRepository,
              $userRepository  
          );
          $execute =  $Service->showall();
          return $execute;
    }
    public function viewallwithotpaging()
    {
        //
          //a
          $SpecialistRepository =  new SpecialistRepository(); 
          $LectureRepository =  new LectureRepository();  
          $userRepository =  new UserRepository();  
          $Service = new LectureService(
              $SpecialistRepository,
              $LectureRepository,
              $userRepository  
          );
          $execute =  $Service->viewallwithotpaging();
          return $execute;
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
        $userRepository =  new UserRepository();  
        $Service = new LectureService(
            $SpecialistRepository,
            $LectureRepository,
            $userRepository  
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
        $SpecialistRepository =  new SpecialistRepository(); 
        $LectureRepository =  new LectureRepository();  
        $userRepository =  new UserRepository();  
        $Service = new LectureService(
            $SpecialistRepository,
            $LectureRepository,
            $userRepository  
        );
            $execute =  $Service->show($id);
            return $execute;
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
          $userRepository =  new UserRepository();  
          $Service = new LectureService(
              $SpecialistRepository,
              $LectureRepository,
              $userRepository  
          );
            $execute =  $Service->update($request);
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
    public function nim($id)
    {
        //
        $SpecialistRepository =  new SpecialistRepository(); 
        $LectureRepository =  new LectureRepository();  
        $userRepository =  new UserRepository();  
        $Service = new LectureService(
            $SpecialistRepository,
            $LectureRepository,
            $userRepository  
        );
            $execute =  $Service->nim($id);
            return $execute;
    }
}
