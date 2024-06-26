<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

Interface EmrRadiologiRepositoryInterface
{
    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request);

    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request);

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request);
}
