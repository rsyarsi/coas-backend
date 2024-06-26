<?php

namespace App\Service;

use Error;
use Exception;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\EmrRadiologiRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class EmrRadiologiService extends Controller
{
    /**
     * @var \App\Repositories\Interfaces\EmrRadiologiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \App\Repositories\Interfaces\EmrRadiologiRepositoryInterface $repository
     * @return void
     */
    public function __construct(EmrRadiologiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function students(Request $request)
    {
        $datas = $this->repository->students($request);

        if ($datas->count()) {

            return $this->sendResponse($datas, "Data tersedia!");

        } else {

            return $this->sendError("Data tidak tersedia!", "");
        }
    }

    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function show($id, Request $request)
    {
        $data = $this->repository->show($id, $request);

        if ($data) {

            return $this->sendResponse($data, "Data tersedia!");

        } else {

            return $this->sendError("Data tidak tersedia!", "");
        }
    }

    /**
     * @param string $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        try {

            DB::beginTransaction();

            $execute = $this->repository->update($id, $request);

            DB::commit();

            if ($execute) {

                return $this->sendResponse($execute, "Status berhasil diproses!");
            }

        } catch (Exception $throwable) {

            DB::rollBack();
            Log::info($throwable->getMessage());

            return $this->sendError("Status gagal diproses!", $throwable->getMessage());
        }
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate(
        [
            "nim" => "required",

            "noepisode" => "required",
            "noregistrasi" => "required",
            "nomr" => "required",
            "patientname" => "required",
            "namajaminan" => "required",
            "noantrianall" => "required",
            "gander" => "required",
            "date_of_birth" => "required",
            "address" => "required",
            "idunit" => "required",
            "namaunit" => "required",
            "iddokter" => "required",
            "namadokter" => "required",
            "patienttype" => "required",

            "jenis_radiologi" => "required",

            "statusid" => "required",

            "visit_date" => "required",
        ]);

        try {

            DB::beginTransaction();

            $id = \Ramsey\Uuid\Uuid::uuid4();

            \App\Models\patient::insert($request->except("nim", "jenis_radiologi"));

            $execute = $this->repository->store(new Request(
            [
                "id" => $id,
                "nim" => $request->nim,
                "noregistrasi" => $request->noregistrasi,
                "noepisode" => $request->noepisode,
                "nomr" => $request->nomr,
                "namapasien" => $request->patientname,
                "namadokter" => $request->namadokter,
                "alamat" => $request->address,
                "usia" => Carbon::parse($request->date_of_birth)->age,
                "jenisradiologi" => $request->jenis_radiologi,
                "jenis_radiologi" => $request->jenis_radiologi,
                "status_emr" => "OPEN",
                "status_penilaian" => "OPEN",
            ]));

            DB::commit();

            if ($execute) {

                $data["idunit"] = $data["idunit"];
                $data["noreg"] = $data["noregistrasi"];
                $data["status_emr"] = "OPEN";
                $data["status_penilaian"] = "OPEN";

                return $this->sendResponse($data, "Status berhasil diproses!");
            }

        } catch (Exception $throwable) {

            DB::rollBack();
            Log::info($throwable->getMessage());

            return $this->sendError("Status gagal diproses!", $throwable->getMessage());
        }
    }
}
