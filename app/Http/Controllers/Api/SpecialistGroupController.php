<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\SpecialistGroupRepository;
use App\Service\SpecialistGroupService;
use Illuminate\Http\Request;

class SpecialistGroupController extends Controller
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
        $Repository =  new SpecialistGroupRepository(); 
        $Service = new SpecialistGroupService(
            $Repository 
        );
        $execute =  $Service->showall();
        return $execute;
    }
    public function viewallwithotpaging()
    {
        //
        $Repository =  new SpecialistGroupRepository(); 
        $Service = new SpecialistGroupService(
            $Repository 
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
        $Repository =  new SpecialistGroupRepository(); 
        $Service = new SpecialistGroupService(
            $Repository 
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
        $Repository =  new SpecialistGroupRepository(); 
        $Service = new SpecialistGroupService(
            $Repository 
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
        $Repository =  new SpecialistGroupRepository(); 
        $Service = new SpecialistGroupService(
            $Repository 
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
