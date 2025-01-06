<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Paciente::all();
        return view('pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre' => 'required | string | max=255',
            'Apellido' => 'required | string | max=255',
            'Cedula' => 'required | integer | min=0 | max=10',
            'CorreoElectronico' => 'required | string | max=255',
            'Direccion' => 'required | string | max=255',
            'Telefono' => 'required | string | max=255'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $patient)
    {
        return view('pacientes.index', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $patient)
    {
        //
    }
}
