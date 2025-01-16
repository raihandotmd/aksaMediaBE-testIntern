<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\DivisionResource;
use Illuminate\Http\JsonResponse;
use App\Models\DivisionModel;
use App\Models\ResponseModel;
use Illuminate\Http\Request;

class DivisionModelController extends BaseController
{
    /**
     * get all divisions data, with pagination and can be filtered by name
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {

        $divisionsData = DivisionModel::paginate(3);

        // filter by name and is string
        if ($request->has('name') && $request->validate(['name' => 'string'])) {
            $divisionsData = DivisionModel::where('name', 'like', '%' . $request->name . '%')->paginate(3);
        } 
        
        if ($divisionsData->isEmpty()) {
            $response = new ResponseModel('error', 'No division data found', null);
            return response()->json($response, 404);
        }

        $pagination = [
            'current_page' => $divisionsData->currentPage(),
            'total' => $divisionsData->total(),
            'per_page' => $divisionsData->perPage(),
            'last_page' => $divisionsData->lastPage(),
            'next_page_url' => $divisionsData->nextPageUrl(),
            'prev_page_url' => $divisionsData->previousPageUrl(),
        ];

        $response = new ResponseModel('success', 'All divisions data', DivisionResource::collection($divisionsData), $pagination);

        return response()->json($response, 200);
    }
}
