<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\AdminRegisterRequest;
use App\Models\User;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        return response()->json([
            'data' => ['message'=>'success']
        ], 201);
    }

    public function login(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'email' => ['Sorry we couldn\'t sign you in with those details.']
                ]
            ], 422);
        }

        return (new UserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
        ]);
    }

    public function user(Request $request)
    {
        return new UserResource($request->user());
    }

    public function logout()
    {
        auth()->user()->token()->revoke();
        return response()->json(['success' =>'logout_success'], 200);
    }

    // Admin register
    protected function adminRegister(AdminRegisterRequest $request)
    {
        $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'is_admin' => 1
        ]);


        return response()->json([
            'data' => ['message'=>'success']
        ], 201);
    }

    public function adminLogin(LoginRequest $request)
    {
        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => [
                    'email' => ['Sorry we couldn\'t sign you in with those details.']
                ]
            ], 422);
        }

        if (!auth()->user()->is_admin) {
            return response()->json([
                'errors' => [
                    'email' => ['Sorry we couldn\'t sign you in with those details.']
                ]
            ], 422);
        }

        return (new UserResource($request->user()))
            ->additional([
                'meta' => [
                    'token' => $token
                ]
        ]);
    }
}