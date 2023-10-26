<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Consulta;
use App\Models\Medico;
use App\Models\Paciente;

class ConsultaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultas = Consulta::with('paciente')->with('medico')->orderBy('data','desc')->get();

        return Inertia::render('Consultas/Index', ['consultas' => $consultas->toArray()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();

        return Inertia::render('Consultas/Create', compact('pacientes','medicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate(Consulta::$storeRules);
        $dados = $request->all();
        $dados['data'] = $request->dt;
        Consulta::create($dados);

        $consultas = Consulta::with('paciente')->with('medico')->orderBy('data','desc')->get();

        return Inertia::render('Consultas/Index', ['consultas' => $consultas->toArray(), 'msg' => 'Consulta criada com sucesso']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
