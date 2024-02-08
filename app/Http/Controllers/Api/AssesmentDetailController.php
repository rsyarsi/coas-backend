<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\AssesmentDetailRepository;
use App\Service\AssesmentDetailService;
use App\Repositories\SpecialistRepository;
use App\Repositories\AssesmentGroupRepository;

class AssesmentDetailController extends Controller
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
    
      /**
    *    @OA\Get(
    *       path="/kategori-berita",
    *       tags={"Berita"},
    *       operationId="kategoriBerita",
    *       summary="Kategori Berita",
    *       description="Mengambil Data Kategori Berita",
    *       @OA\Response(
    *           response="200",
    *           description="Ok",
    *           @OA\JsonContent
    *           (example={
    *               "success": true,
    *               "message": "Berhasil mengambil Kategori Berita",
    *               "data": {
    *                   {
    *                   "id": "1",
    *                   "nama_kategori": "Pendidikan",
    *                  }
    *              }
    *          }),
    *      ),
    *  )
    */
    public function create()
    {
        //
        $Repository =  new SpecialistRepository(); 
        $AssesmentRepository =  new AssesmentGroupRepository(); 
        $AssesmentdetailRepository = new AssesmentDetailRepository();
        $Service = new AssesmentDetailService(
            $Repository,
            $AssesmentRepository,   
            $AssesmentdetailRepository

        );
        $execute =  $Service->showall();
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
        $AssesmentdetailRepository = new AssesmentDetailRepository();
        $Service = new AssesmentDetailService(
            $Repository,
            $AssesmentRepository,   
            $AssesmentdetailRepository

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
        $AssesmentdetailRepository = new AssesmentDetailRepository();
        $Service = new AssesmentDetailService(
            $Repository,
            $AssesmentRepository,   
            $AssesmentdetailRepository

        );
        $execute =  $Service->show($id);
        return $execute;
    }
    public function groupid($id)
    {
        //
        $Repository =  new SpecialistRepository(); 
        $AssesmentRepository =  new AssesmentGroupRepository(); 
        $AssesmentdetailRepository = new AssesmentDetailRepository();
        $Service = new AssesmentDetailService(
            $Repository,
            $AssesmentRepository,   
            $AssesmentdetailRepository

        );
        $execute =  $Service->groupid($id);
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
        $AssesmentdetailRepository = new AssesmentDetailRepository();
        $Service = new AssesmentDetailService(
            $Repository,
            $AssesmentRepository,   
            $AssesmentdetailRepository

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
