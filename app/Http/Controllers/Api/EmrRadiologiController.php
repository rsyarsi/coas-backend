<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\EmrRadiologiRepository;
use App\Service\EmrRadiologiService;
use App\Traits\AwsTrait;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class EmrRadiologiController extends Controller
{
    use AwsTrait;

    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        $repository = new EmrRadiologiRepository();
        $services = new EmrRadiologiService($repository);
        $execute = $services->show($id, $request);

        return $execute;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $repository = new EmrRadiologiRepository();
        $services = new EmrRadiologiService($repository);
        $execute = $services->update($request->id, new Request($request->except("id")));

        return $execute;
    }

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

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function student(Request $request)
    {
        $repository = new EmrRadiologiRepository();
        $services = new EmrRadiologiService($repository);
        $execute = $services->student($request);

        return $execute;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function upload(Request $request)
    {
        $file = $request->file("file");
        $name = Uuid::uuid4().".".$file->getClientOriginalExtension();
        $path = "emr/radiologi/";

        $file->move(storage_path("app/"), $name);
        $filed = $this->UploadtoAWS($name, $path);
        unlink(storage_path()."/app/". $name);

        $data = [

            "updated_at" => Carbon::now()->format('Y-m-d'),
            "url" => $filed,
        ];

        return $this->sendResponse($data, "File berhasil diupload!");
    }
}
