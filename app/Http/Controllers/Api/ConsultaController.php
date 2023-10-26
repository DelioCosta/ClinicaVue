<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Consulta;

class ConsultaController extends Controller
{
    public function getOne(Request $request)
    {
        $consulta = Consulta::where('data', $request->data)
                    ->where('medico_id', $request->medico_id)
                    ->where('hora_inicio', $request->hora)
                    ->first();

        if($consulta){
            return response([
                "status" => "false",
                "message" => "Médico já possui consulta neste horário"
            ]);
        } else{
            return response([
                "status" => "sucess",
                "message" => "Horário dispoível para este médico"
            ]);
        }

    }
}
