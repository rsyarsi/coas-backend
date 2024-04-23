<?php

namespace App\Repositories;

use Error;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Repositories\Interfaces\EmrRadiologiRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class EmrRadiologiRepository extends Controller implements EmrRadiologiRepositoryInterface
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function students(Request $request)
    {
        $data = DB::table("students")->join(DB::raw("(SELECT * FROM specialists WHERE specialistname LIKE '%adiologi%') AS specialists"), "students.specialistid", "=", "specialists.id")->select("students.*", "specialists.specialistname as specialistname")->get();

        return $data;
    }

    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        $data = DB::table("emrradiologies");

        if ($request->query("nim")) $data = $data->where("nim", "=", $request->query("nim"));

        $data = $data->where("noregistrasi", "=", (string) $id)->first();

        if (! $data) $data = collect(Schema::getColumnListing("emrradiologies"))->map(function ($item) { return [ $item => null ]; })->collapse();

        return $data;
    }

    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        $data = DB::table("emrradiologies")->where("noregistrasi", "=", $id);

        $updated = $data->update($request->all());

        return $data->first();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = DB::table("emrradiologies")->insert($request->all());

        return $data;
    }
}
