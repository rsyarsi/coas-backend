<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmrOrtodonsiRepository;
use App\Service\EmrOrtodonsiService;
use Illuminate\Http\Request;

class EmrOrtodonsiController extends Controller
{
    /**
     * Display a listing of the aresource.
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
     * Store a newly created resource in astorage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->createwaktuperawatan($request);
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
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
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
    public function uploadfoto(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadfoto($request);
        return $execute;
    }

    public function uploadtampakdepan(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadtampakdepangeli($request);
        return $execute;
    }
    public function uploadfotosenyum(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadfotosenyum($request);
        return $execute;
    }
    public function uploadfotosamping(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadfotosamping($request);
        return $execute;
    }
    public function uploadfotomiring(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadfotomiring($request);
        return $execute;
    }

    // geligeli
    public function uploadtampaksampingkanan(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadtampaksampingkanan($request);
        return $execute;
    }
    public function uploadtampakdepangeli(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadtampakdepangeli($request);
        return $execute;
    }
    public function uploadtampaksampingkiri(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadtampaksampingkiri($request);
        return $execute;
    }
    public function uploadtampakoklusalatas(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadtampakoklusalatas($request);
        return $execute;
    }
    public function uploadtampakoklusalbawah(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadtampakoklusalbawah($request);
        return $execute;
    }

    public function uploadmodelstudi(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadmodelstudi($request);
        return $execute;
    }

    public function uploadsefalometri(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadsefalometri($request);
        return $execute;
    }

    public function uploadpanoramik(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadpanoramik($request);
        return $execute;
    }
    public function uploadanalisaetiologi(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadanalisaetiologi($request);
        return $execute;
    }

    //jalanperawatan
    public function uploadpencarianruang(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadpencarianruang($request);
        return $execute;
    }
    public function uploadrahangatas(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadrahangatas($request);
        return $execute;
    }
    public function uploadrahangbawah(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadrahangbawah($request);
        return $execute;
    }
    public function uploadretainer(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadretainer($request);
        return $execute;
    }

    // plakat
    public function uploadplakatrahangatas(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadplakatrahangatas($request);
        return $execute;
    }
    public function uploadplakatrahangbawah(Request $request)
    {
        //
        $yearRepository =  new EmrOrtodonsiRepository();
        $aReturBeliService = new EmrOrtodonsiService(
            $yearRepository
        );
        $execute =  $aReturBeliService->uploadplakatrahangbawah($request);
        return $execute;
    }
}
