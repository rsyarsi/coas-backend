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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        return DB::table("emrradiologies")->insert($request->all());
    }
}
