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
        $pacientes = Paciente::all();
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
            'cedula' => 'required | string | max:255',
            'nombre' => 'required | string | max:255',
            'apellido' => 'required | string | max:255',
            'telefono' => 'required | string | max:255',
            'direccion' => 'required | string | max:255',
            'correoelectronico' => 'required | string | max:255',
        ]);

        Paciente::create($request->all());
        return redirect()->route('pacientes.index')->with('success','Paciente creado satisfactoriamente'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
    {
        return view('pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'cedula' => 'required | string | max:255',
            'nombre' => 'required | string | max:255',
            'apellido' => 'required | string | max:255',
            'telefono' => 'required | string | max:255',
            'direccion' => 'required | string | max:255',
            'correoelectronico' => 'required | string | max:255',
        ]);

        $paciente->update($request->all());
        return redirect()->route('pacientes.index')->with('success','Paciente actualizado satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')->with('success','Paciente eliminado satisfactoriamente');
    }
}
