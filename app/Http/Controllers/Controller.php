<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
 /**
    * @OA\Info(
    *      version="1.0.0",
    *      title="Dokumentasi API SIKMFKG YARSI",
    *      description="Lorem Ipsum",
    *      @OA\Contact(
    *          email="muchsin@rsyarsi.co.id"
    *      ),
    *      @OA\License(
    *          name="Apache 2.0",
    *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
    *      )
    * )
    *
    * @OA\Server(
    *      url=L5_SWAGGER_CONST_HOST,
    *      description="Demo API Server"
    * )
    */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function sendResponse($result , $message)
    {
        $response = [
            'status' => true, 
            'code' => 200,
            'message' => $message, 
        ];
        if (!empty($result)) {
            $response['data'] = $result;
        }
        return response()->json($response, 200);
    }
    public function sendResponseNew($data , $message)
    {
        return response()->json(['response' => $data, 'metadata' => $message], 200);
    }
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'status' => false,
            'code' => 422,
            'message' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
    public function sendErrorNew($errorMessage, $errorData = [])
    {
        if (!empty($errorData)) {
            $errorMessage['data'] = $errorData;
        }
        return response()->json(['metadata' => $errorMessage]);
    }
    public function sendErrorTrsNew($errorMessage, $errorData = [])
    {
       
        return response()->json(['response' => $errorMessage, 'metadata' => $errorData],201);
    }
}
