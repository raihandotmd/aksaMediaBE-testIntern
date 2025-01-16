<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ResponseModel;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * send api response, with status, message, and data
     * @param ResponseModel $responseModel
     * @param int $statusCode
     * @return JsonResponse
     */
    public function sendResponse(ResponseModel $responseModel, int $statusCode): JsonResponse
    {
        return response()->json($responseModel, $statusCode);
    }
}
