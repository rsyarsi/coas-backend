<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\AssesmentGroupFinalRepository;
use App\Service\AssesmentGroupFinalService;
use Illuminate\Http\Request;

class AssesmentGroupFinalController extends Controller
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
        $AssesmentRepository =  new AssesmentGroupFinalRepository(); 
        $Service = new AssesmentGroupFinalService( 
            $AssesmentRepository
        );
        $execute =  $Service->showall();
        return $execute;
    }
    public function viewallwithotpaging()
    {
        //
        $AssesmentRepository =  new AssesmentGroupFinalRepository(); 
        $Service = new AssesmentGroupFinalService( 
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
        $AssesmentRepository =  new AssesmentGroupFinalRepository(); 
        $Service = new AssesmentGroupFinalService( 
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
        $AssesmentRepository =  new AssesmentGroupFinalRepository(); 
        $Service = new AssesmentGroupFinalService( 
            $AssesmentRepository
        );
        $execute =  $Service->show($id);
        return $execute;
    }
    public function byspecialist($id)
    {
        //
        $AssesmentRepository =  new AssesmentGroupFinalRepository(); 
        $Service = new AssesmentGroupFinalService( 
            $AssesmentRepository
        );
        $execute =  $Service->byspecialist($id);
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
        $AssesmentRepository =  new AssesmentGroupFinalRepository(); 
        $Service = new AssesmentGroupFinalService( 
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
