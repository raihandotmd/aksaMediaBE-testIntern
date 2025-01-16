<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use App\Http\Resources\EmployeeResource;
use App\Models\EmployeeModel;
use App\Models\ResponseModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends BaseController
{
    /**
     * get all employees data, with pagination and can be filtered by name or division_id
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {

        // sets the number of items per page
        $page_size = 3;

        // Build the query with optional filters
        $query = EmployeeModel::with('division');

        if ($request->has('name')) {
            $request->validate(['name' => 'string']);
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('division_id')) {
            $request->validate(['division_id' => 'string']);
            $query->where('division_id', $request->division_id);
        }

        $employeesData = $query->paginate($page_size);

        if ($employeesData->isEmpty()) {
            $response = new ResponseModel('error', 'No employee data found', null);
            return response()->json($response, 404);
        }

        $pagination = [
            'current_page' => $employeesData->currentPage(),
            'total' => $employeesData->total(),
            'per_page' => $employeesData->perPage(),
            'last_page' => $employeesData->lastPage(),
            'next_page_url' => $employeesData->nextPageUrl(),
            'prev_page_url' => $employeesData->previousPageUrl(),
        ];

        $response = new ResponseModel('success', 'All employees data', EmployeeResource::collection($employeesData), $pagination);

        return response()->json($response, 200);
    }

    /**
     * create a new employee data
     * @param Request $request
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|string',
            'name' => 'required|string',
            'phone' => 'required|string',
            'division_id' => 'required|exists:divisions,id|string',
            'position' => 'required|string',
        ]);
        
        // stricting request to only needed data
        $employee = EmployeeModel::create($request->only(['image', 'name', 'phone', 'division_id', 'position']));

        $response = new ResponseModel('success', 'Employee data created');

        return response()->json($response, 201);
    }
}