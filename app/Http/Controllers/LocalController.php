<?php

namespace App\Http\Controllers;

use App\Http\Requests\Local\CreateLocalRequest;
use App\Http\Requests\Local\UpdateLocalRequest;
use App\Models\Local;
use App\Models\User;
use App\Services\LocalServices;
use Illuminate\Http\Request;

class LocalController extends Controller
{

    private LocalServices $localServices;

    public function __construct(
        LocalServices $localServices
    )
    {
        $this->localServices = $localServices;
    }

    public function index()
    {
        return response()->json(['locals'=>$this->localServices->getAll()], 200);
    }

    public function getOne(Local $local)
    {
        return response()->json(['local'=>$local], 200);
    }
    public function create(CreateLocalRequest $request)
    {
        $request->validated();

        $local = $this->localServices->createLocal($request);

        if(!$local)
            return response()->json(['error' => 'verifique com o suporte!'], 500);

        return response()->json(['success' => 'Local criado, com sucesso!', 'data' => $local], 200);

    }
    public function update(UpdateLocalRequest $request)
    {
        $request->validated();

        $localUpdate = $this->localServices->updateLocal($request);

        if(!$localUpdate)
            return response()->json(['error' => 'verifique com o suporte!'], 500);

        return response()->json(['data' => $localUpdate], 200);


    }

    public function deleteForce(Local $local)
    {
        $local->forceDelete();
        return response()->json(['message'=> 'Local excluido!'], 200);
    }


}
