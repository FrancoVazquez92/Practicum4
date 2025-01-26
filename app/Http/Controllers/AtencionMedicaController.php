<?php

namespace App\Http\Controllers;

use App\Models\AtencionMedica;
use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;

class AtencionMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atenciones = AtencionMedica::all(); 
        return view('atencionmedicas.index', compact('atenciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $citas = CitaMedica::all();  // Obtener las citas médicas disponibles
        $pacientes = Paciente::all();  // Obtener los pacientes disponibles
        $medicos = Medico::all();  // Obtener los médicos disponibles

        return view('atencionmedicas.create', compact('citas', 'pacientes', 'medicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      

        AtencionMedica::create($request->all());

        return redirect()->route('atencionmedicas.index')->with('success', 'Atención médica registrada exitosamente');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $atenciones = AtencionMedica::with('paciente', 'medico')->findOrFail($id);

        return view('atencionmedicas.show', compact('atenciones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $atencion = AtencionMedica::with('paciente', 'medico')->findOrFail($id); // Obtiene la cita médica por ID
        $citas = CitaMedica::all(); // Lista de pacientes
        $pacientes = Paciente::all(); // Lista de pacientes
        $medicos = Medico::all(); // Lista de médicos

        return view('atencionmedicas.edit', compact('atencion', 'citas', 'pacientes', 'medicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $atencion = AtencionMedica::findOrFail($id);
        $atencion->update($request->all());
        return redirect()->route('atencionmedicas.index')->with('success','Atencion Medica actualiza satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $atencion = CitaMedica::findOrFail($id);
        $atencion->delete();
        return redirect()->route('atencionmedicas.index')->with('success', 'Atencion médica eliminada correctamente.');
    }
}
