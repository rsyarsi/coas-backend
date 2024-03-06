<?php

namespace Src\V2\Hospitals\Http\Controllers\API;

use Src\V2\Hospitals\Repositories\HospitalRepository;
use Src\V2\Hospitals\Services\HospitalService;
use Src\V2\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

class HospitalController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v2/master/hospitals/select",
     *      tags={"Master Hospital"},
     *      summary="Select",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function select(Request $request)
    {
        return (new HospitalService(new HospitalRepository()))->select();
    }

    /**
     * @OA\Get(
     *      path="/api/v2/master/hospitals",
     *      tags={"Master Hospital"},
     *      summary="Index",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="limit",
     *          description="Hospital's Pagination Limit."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="current_page",
     *          description="Hospital's Pagination Current Page."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="order",
     *          description="Hospital's Pagination Order."
     *      ),
     *      @OA\Parameter(
     *          required=false,
     *          in="query",
     *          name="filter[]",
     *          description="Hospital's Pagination Filter."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $datas = array_merge(Route::getCurrentRoute()->parameters(), $request->all());

        return (new HospitalService(new HospitalRepository()))->index($datas);
    }

    /**
     * @OA\Get(
     *      path="/api/v2/master/hospitals/{id}",
     *      tags={"Master Hospital"},
     *      summary="Show",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="id",
     *          description="Hospital's Identifier."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Request $request, $id)
    {
        $datas = array_merge(Route::getCurrentRoute()->parameters(), $request->all());

        return (new HospitalService(new HospitalRepository()))->show($datas);
    }

    /**
     * @OA\Post(
     *      path="/api/v2/master/hospitals",
     *      tags={"Master Hospital"},
     *      summary="Store",
     *      security={{ "bearerAuth": {} }},
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Hospital's Name."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $datas = array_merge(Route::getCurrentRoute()->parameters(), $request->all());

        return (new HospitalService(new HospitalRepository()))->store($datas);
    }

    /**
     * @OA\Put(
     *      path="/api/v2/master/hospitals/{id}",
     *      tags={"Master Hospital"},
     *      summary="Update",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="id",
     *          description="Hospital's Identifier."
     *      ),
     *      @OA\RequestBody(
     *          @OA\MediaType(
     *              mediaType="application/x-www-form-urlencoded",
     *              @OA\Schema(
     *                  @OA\Property(
     *                      property="name",
     *                      type="string",
     *                      description="Hospital's Name."
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $datas = array_merge(Route::getCurrentRoute()->parameters(), $request->all());

        return (new HospitalService(new HospitalRepository()))->update($datas);
    }

    /**
     * @OA\Delete(
     *      path="/api/v2/master/hospitals/{id}",
     *      tags={"Master Hospital"},
     *      summary="Destroy",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="id",
     *          description="Hospital's Identifier."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        $datas = array_merge(Route::getCurrentRoute()->parameters(), $request->all());

        return (new HospitalService(new HospitalRepository()))->destroy($datas);
    }

    /**
     * @OA\Put(
     *      path="/api/v2/master/hospitals/activate/{id}",
     *      tags={"Master Hospital"},
     *      summary="Activate",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="id",
     *          description="Hospital's Identifier."
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Request $request, $id)
    {
        $datas = array_merge(Route::getCurrentRoute()->parameters(), $request->all());

        return (new HospitalService(new HospitalRepository()))->activate($datas);
    }

    /**
     * @OA\Put(
     *      path="/api/v2/master/hospitals/deactivate/{id}",
     *      tags={"Master Hospital"},
     *      summary="Deactivate",
     *      security={{ "bearerAuth": {} }},
     *      @OA\Parameter(
     *          required=true,
     *          in="path",
     *          name="id",
     *          description="Hospital's Identifier."
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Created."
     *      ),
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity."
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Not Found."
     *      )
     * )
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deactivate(Request $request, $id)
    {
        $datas = array_merge(Route::getCurrentRoute()->parameters(), $request->all());

        return (new HospitalService(new HospitalRepository()))->deactivate($datas);
    }
};
