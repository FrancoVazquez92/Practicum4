<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citas = CitaMedica::with(['paciente', 'medico'])->get();
        return view('citasmedicas.index', compact('citas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pacientes = Paciente::all(['id', 'nombre', 'apellido']);
        $medicos = Medico::all(['id', 'nombre', 'apellido']);

        return view('citasmedicas.create', compact('pacientes', 'medicos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'paciente_id' => 'required|exists:pacientes,id',
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        CitaMedica::create($request->all());

        return redirect()->route('citasmedicas.index')->with('success', 'Cita médica creada exitosamente.');


    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $citas = CitaMedica::with('paciente', 'medico')->findOrFail($id);

        return view('citasmedicas.show', compact('citas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cita = CitaMedica::findOrFail($id); // Obtiene la cita médica por ID
        $pacientes = Paciente::all(); // Lista de pacientes
        $medicos = Medico::all(); // Lista de médicos

        return view('citasmedicas.edit', compact('cita', 'pacientes', 'medicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $cita = CitaMedica::findOrFail($id);
        $cita->update($request->all());
        return redirect()->route('citasmedicas.index')->with('success','Cita Medica actualiza satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cita = CitaMedica::findOrFail($id);
        $cita->delete();
        return redirect()->route('citasmedicas.index')->with('success', 'Cita médica eliminada correctamente.');
    }
    public function detalles($id)
    {
        $cita = CitaMedica::with(['paciente', 'medico'])->findOrFail($id);

        return response()->json([
            'paciente' => $cita->paciente,
            'medico' => $cita->medico,
        ]);
    }
}
