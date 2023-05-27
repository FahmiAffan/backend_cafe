<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class GetUser extends Controller
{
    //
    public function sendResponse($data, $message, $status = 200)
    {
        $response = [
            'data' => $data,
            'message' => $message
        ];

        return response()->json($response, $status);
    }

    public function sendError($errorData, $message, $status = 500)
    {
        $response = [];
        $response['message'] = $message;
        if (!empty($errorData)) {
            $response['data'] = $errorData;
        }

        return response()->json($response, $status);
    }

    public function getUser()
    {
        $user = User::get();
        return response()->json($user);
        // try {
        //     $user = JWTAuth::parseToken()->authenticate();
        //     if (!$user) {
        //         return $this->sendError([], "user not found", 403);
        //     }
        // } catch (JWTException $e) {
        //     return $this->sendError([], $e->getMessage(), 500);
        // }

        // return $this->sendResponse($user, "user data retrieved", 200);
    }
}
