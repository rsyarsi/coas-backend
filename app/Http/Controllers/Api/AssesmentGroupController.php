<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AssesmentGroupRepository;
use App\Repositories\SpecialistRepository;
use App\Service\AssesmentGroupService;

class AssesmentGroupController extends Controller
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
        $Repository =  new SpecialistRepository(); 
        $AssesmentRepository =  new AssesmentGroupRepository(); 
        $Service = new AssesmentGroupService(
            $Repository,
            $AssesmentRepository
        );
        $execute =  $Service->showall();
        return $execute;
    }
    public function viewallwithotpaging()
    {
        //
        $Repository =  new SpecialistRepository(); 
        $AssesmentRepository =  new AssesmentGroupRepository(); 
        $Service = new AssesmentGroupService(
            $Repository,
            $AssesmentRepository
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
        $Repository =  new SpecialistRepository(); 
        $AssesmentRepository =  new AssesmentGroupRepository(); 
        $Service = new AssesmentGroupService(
            $Repository,
            $AssesmentRepository
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
        $Repository =  new SpecialistRepository(); 
        $AssesmentRepository =  new AssesmentGroupRepository(); 
        $Service = new AssesmentGroupService(
            $Repository,
            $AssesmentRepository
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
        $Repository =  new SpecialistRepository(); 
        $AssesmentRepository =  new AssesmentGroupRepository(); 
        $Service = new AssesmentGroupService(
            $Repository,
            $AssesmentRepository
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
}
