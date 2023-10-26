<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserServices;

class AuthController extends Controller
{
    private UserServices $userServices;

    public function __construct(
        UserServices $userServices
    )
    {
        $this->userServices = $userServices;
    }


    public function login (AuthRequest $request)
    {
        $request->validated();
        $crendentials = $request->only('email', 'password');
        if(!auth()->attempt($crendentials)){
            abort(401, 'Invalid crendentials');
        }
        // config(['auth.guards.api.provider' => 'api']);
        // $token = Auth::guard('api')->user()->createToken('fs', ['api'] )->accessToken;
        $token = auth()->user()->createToken('fs_auth');

        return response()->json(['data' => [
            'token' => $token->plainTextToken,
        ]], 200);

    }

    public function register(RegisterRequest $request, User $user)
    {
        $request->validated();
        $userData = $this->userServices->createUser($request);


        return response()->json(['data' => [
            'user' => $userData
        ]], 200);

    }

    public function logout()
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([], 204);
    }

}
