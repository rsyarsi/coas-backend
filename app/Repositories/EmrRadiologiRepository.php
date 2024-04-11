<?php

namespace App\Repositories;

use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\Interfaces\EmrRadiologiRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class EmrRadiologiRepository extends Controller implements EmrRadiologiRepositoryInterface
{
    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        return DB::table("emrradiologies")->where("id", "=", $id)->get();
    }

    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        return DB::table("emrradiologies")->where("id", "=", $id)->update($request->all());
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return DB::table("emrradiologies")->insert($request->all());
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function student(Request $request)
    {
        return DB::table("students")->join(DB::raw("(SELECT * FROM specialists WHERE specialistname LIKE '%adiologi%') AS specialists"), "students.specialistid", "=", "specialists.id")->select("students.*", "specialists.specialistname as specialistname")->get();
    }
}
