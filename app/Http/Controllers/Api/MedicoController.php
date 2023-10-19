<?php

namespace App\Http\Controllers\Api;

use App\Models\Medico;
use App\Http\Controllers\Controller;
use App\Http\Resources\MedicoResource;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return MedicoResource::collection(Medico::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Medico::$storeRules);

        $medico = Medico::create($request->all());

        return new MedicoResource($medico);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $medico = Medico::find($id);
        if(!$medico){
            return response([
                "status" => "error",
                "message" => "Médico não encontrado!"
            ], 404);
        }
        return new MedicoResource($medico);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(Medico::$updateRules);

        $medico = Medico::find($id);
        if(!$medico){
            return response([
                "status" => "error",
                "message" => "Médico não encontrado!"
            ], 404);
        }
        $medico->update($request->all());
        return new MedicoResource($medico);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $medico = Medico::find($id);
        if(!$medico){
            return response([
                "status" => "error",
                "message" => "Médico não encontrado!"
            ], 404);
        }
        return response([
            "status" => "sucess",
            "message" => "Médico excluido!"
        ]);
    }
}
