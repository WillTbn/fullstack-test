<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserServices $userServices;

    public function __construct(
        UserServices $userServices
    )
    {
        $this->userServices = $userServices;
    }

    public function index()
    {
        return response()->json(['data' => [
            'users' => $this->userServices->getAll(),
        ]], 200);
    }

    public function getOne(User $user)
    {
        if(!$user){
            abort(400, 'Usuário não existente');
        }
        return response()->json(['data' => [
            'users' => $user,
        ]], 200);
    }

    public function update(UpdateUserRequest $request)
    {
        $request->validated();
        $userUpdate = $this->userServices->updateUser($request);

        return response()->json(['data' => [
            'user' => $userUpdate
        ]], 200);
    }
    public function deleteForce(User $user)
    {
        $user->forceDelete();
        return response()->json(['message'=> 'Usuario excluido do sistema!'], 200);
    }

}
