<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\api\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\ResponseModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{
    /**
     * Function for admin login
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        // validate request, only accept username and password
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $request->username)->first();

        // check if user not found or password not match
        if (!$user || !Hash::check($request->password, $user->password)) {

            $resModel = new ResponseModel('error', 'Unauthorize, Incorrect Credentials', null);
            return $this->sendResponse($resModel, 401);
        }

        // handle login success
        $token = $user->createToken('loginToken')->plainTextToken;

        // remove email_verified_at, created_at, updated_at
        $user->makeHidden(['email_verified_at', 'created_at', 'updated_at']);

        $data = ['token' => $token, 'admin' => $user];

        $resModel = new ResponseModel('success', 'You have been Authenticated!', $data);

        return $this->sendResponse($resModel, 200);
    }

    /**
     * Function for admin logout
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
            $resModel = new ResponseModel('success', 'You have been logged out!', null);
            return response()->json($resModel, 200);
        }

        $resModel = new ResponseModel('error', 'No active session found!', null);
        return response()->json($resModel, 400);
    }
}
