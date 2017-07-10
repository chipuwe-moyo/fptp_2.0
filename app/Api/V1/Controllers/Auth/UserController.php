<?php

namespace App\Api\V1\Controllers\Auth;

use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\RegisterRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public function register(RegisterRequest $request, JWTAuth $JWTAuth)
    {
        $user = new User($request->all());
        if (!$user->save()) {
            throw new HttpException(500);
        }

        if (!Config::get('boilerplate.register.release_token')) {
            return response()->json([
                'message' => 'Successfully created user!'
            ], 201);
        }

        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'status' => 'ok',
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $credentials = $request->only(['username', 'password']);

        try {
            $token = $JWTAuth->attempt($credentials);

            if (!$token) {
                return response()->json([
                    'error' => 'Invalid Credentials!'
                ], 401);
            }

        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token!'
            ], 500);
        }

        return response()
            ->json([
                'status' => 'ok',
                'token' => $token
            ], 200);
    }
}