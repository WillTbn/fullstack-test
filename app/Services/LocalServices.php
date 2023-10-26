<?php

namespace App\Services;

use App\Http\Requests\Local\CreateLocalRequest;
use App\Http\Requests\Local\UpdateLocalRequest;
use App\Models\Local;
use App\Models\User;


class LocalServices
{
    public function getAll()
    {
        $local= Local::all();

        return $local;
    }


    public function createLocal(CreateLocalRequest $local)
    {
        $newLocal = new Local();
        $newLocal->name = $local->name;
        $newLocal->zip_code = $local->zip_code;
        $newLocal->street = $local->street;
        $newLocal->city = $local->city;
        $newLocal->number = $local->number;
        $newLocal->user_id = auth()->user()->id;
        $newLocal->saveOrFail();

        //  BOM CRIA UM JOB PARA EXECUTA O ENVIO DO E-MAIL - por não ter tempo,fiz dessa forma
        // Mail::to($newUser->email, $newUser->name)->send( new WelcomeEmail($newUser->name, $user->password));

        return $newLocal;
    }

    public function updateLocal(UpdateLocalRequest $local)
    {
        $upLocal = Local::find($local->id);

        $upLocal->name = $local->name;
        $upLocal->zip_code = $local->zip_code;
        $upLocal->street = $local->street;
        $upLocal->city = $local->city;
        $upLocal->number = $local->number;

        $upLocal->saveOrFail();

        return $upLocal;
    }
}
