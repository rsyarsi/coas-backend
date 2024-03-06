<?php

namespace Src\V2\Hospitals\Services;

use Src\V2\Hospitals\Models\HospitalModel;
use Src\V2\Hospitals\Repositories\Contracts\HospitalContract;
use Src\V2\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class HospitalService extends Controller
{
    /**
     * @var \Src\V2\Hospitals\Repositories\Contracts\HospitalContract
     */
    protected $repository;

    /**
     * @param \Src\V2\Hospitals\Repositories\Contracts\HospitalContract $repository
     * @return void
     */
    public function __construct(HospitalContract $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function select()
    {
        $data = $this->repository->select();

        return $this->sendResponse($data, "Succeed");
    }

    /**
     * @param array $datas
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($datas)
    {
        $data = $this->repository->all($datas);

        return $this->sendResponse($data, "Succeed");
    }

    /**
     * @param array $datas
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($datas)
    {
        $validator = Validator::make($datas,
        [
            "id" => "required|uuid|exists:".HospitalModel::class.",id,active,1",
        ]);

        if (! $validator->fails()) {

            $data = $this->repository->get($datas["id"]);

            return $this->sendResponse($data, "Succeed");
        }

        return $this->sendError("Failed", $validator->messages()->get("*"));
    }

    /**
     * @param array $datas
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($datas)
    {
        $validator = Validator::make($datas,
        [
            "id" => "required|uuid|exists:".HospitalModel::class.",id,active,1",
            "name" => [ "required", "string", "min:5", "max:250", Rule::unique(HospitalModel::class)->ignore($datas["id"]), ],
        ]);

        if (! $validator->fails()) {

            $data = $this->repository->update($datas["id"], $datas);

            return $this->sendResponse($data, "Succeed");
        }

        return $this->sendError("Failed", $validator->messages()->get("*"));
    }

    /**
     * @param array $datas
     * @return \Illuminate\Http\JsonResponse
     */
    public function store($datas)
    {
        $validator = Validator::make($datas,
        [
            "name" => "required|string|min:5|max:250|unique:".HospitalModel::class.",name",
        ]);

        if (! $validator->fails()) {

            $data = $this->repository->create($datas);

            return $this->sendResponse($data, "Succeed");
        }

        return $this->sendError("Failed", $validator->messages()->get("*"));
    }

    /**
     * @param array $datas
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($datas)
    {
        return $this->deactivate($datas);
    }

    /**
     * @param array $datas
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate($datas)
    {
        $validator = Validator::make($datas,
        [
            "id" => "required|uuid|exists:".HospitalModel::class.",id,active,0",
        ]);

        if (! $validator->fails()) {

            $data = $this->repository->activate($datas["id"]);

            return $this->sendResponse($data, "Succeed");
        }

        return $this->sendError("Failed", $validator->messages()->get("*"));
    }

    /**
     * @param array $datas
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate($datas)
    {
        $validator = Validator::make($datas,
        [
            "id" => "required|uuid|exists:".HospitalModel::class.",id,active,1",
        ]);

        if (! $validator->fails()) {

            $data = $this->repository->deactivate($datas["id"]);

            return $this->sendResponse($data, "Succeed");
        }

        return $this->sendError("Failed", $validator->messages()->get("*"));
    }
};
