<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private UserServices $userServices;

    public function __construct(
        UserServices $userServices
    )
    {
        $this->userServices = $userServices;
    }
    public function validateToken()
    {
        $user = Auth::guard('sanctum')->user();

        return response()->json([
            'message' => 'Usuário Logado!',
            'user' => $user,
        ], 200);
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
        return response()->json([
            'message' => 'Login efetuado!',
            'user' => [...auth()->user()->only('email','name', 'role_id')],
            'token' => $token->plainTextToken
        ], 200);
        return response()->json(['response' => [
            'token' => $token->plainTextToken,
            // 'data' => [...auth()->user()->only('email','name', 'role_id')]
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
