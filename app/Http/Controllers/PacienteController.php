<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Paciente;

class PacienteController extends Controller
{

    public function index()
    {
        $pacientes = Paciente::all();
        return Inertia::render('Pacientes/Index',compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Pacientes/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Paciente::$storeRules);

        $paciente = Paciente::create($request->all());

        if($request->foto){
            $fileName = $paciente->id.str_replace(' ', '_', $paciente->nome).'.'.$request->foto->extension();
            $request->foto->move(public_path('fotos'), $fileName);
            $paciente->foto = 'fotos/'.$fileName;
            $paciente->save();
        }

        return redirect('pacientes');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect('pacientes');

    }
}
