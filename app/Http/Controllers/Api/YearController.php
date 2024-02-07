<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;  
use App\Http\Controllers\Controller; 
use App\Repositories\YearRepository;
use App\Service\YearsService;

class YearController extends Controller
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
        $yearRepository =  new YearRepository(); 
        $aReturBeliService = new YearsService(
            $yearRepository 
        );
        $execute =  $aReturBeliService->showall();
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
        $yearRepository =  new YearRepository(); 
        $aReturBeliService = new YearsService(
            $yearRepository 
        );
        $execute =  $aReturBeliService->storeData($request);
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
        $yearRepository =  new YearRepository(); 
        $aReturBeliService = new YearsService(
            $yearRepository 
        );
        $execute =  $aReturBeliService->show($id);
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
        $yearRepository =  new YearRepository(); 
        $aReturBeliService = new YearsService(
            $yearRepository 
        );
        $execute =  $aReturBeliService->update($request);
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
