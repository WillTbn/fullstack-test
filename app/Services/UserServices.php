<?php

namespace App\Services;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Mail\invitation\WelcomeEmail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserServices
{
    public function getAll()
    {
        $users= User::whereNot('id', auth()->user()->id)->get();

        return $users;
    }


    public function createUser(RegisterRequest $user)
    {
        $newUser = new User();
        $newUser->name = $user->name;
        $newUser->email = $user->email;
        $newUser->password = Hash::make($user->password);
        $newUser->role_id = $user->role_id;
        $newUser->saveOrFail();

        //  BOM CRIA UM JOB PARA EXECUTA O ENVIO DO E-MAIL - por não ter tempo,fiz dessa forma
        Mail::to($newUser->email, $newUser->name)->send( new WelcomeEmail($newUser->name, $user->password));

        return $newUser;
    }

    public function updateUser(UpdateUserRequest $user)
    {
        $upUser = User::find($user->id);

        $upUser->name = $user->name;
        $upUser->role_id = $user->role_id;

        $upUser->saveOrFail();

        return $upUser;
    }
}
