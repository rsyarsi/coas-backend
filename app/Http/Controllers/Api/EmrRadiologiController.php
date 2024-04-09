<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmrRadiologiRepository;
use App\Service\EmrRadiologiService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class EmrRadiologiController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $repository = new EmrRadiologiRepository();
        $services = new EmrRadiologiService($repository);
        $execute = $services->store($request);

        return $execute;
    }
}
