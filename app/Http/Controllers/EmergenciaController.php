<?php

namespace App\Http\Controllers;



use App\Models\Emergencia;
use App\Models\Triaje;
use App\Models\Paciente;
use Illuminate\Http\Request;

class EmergenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_emergencias');
    }
    public function index()
    {
        $emergencias = Emergencia::all();
        return view('emergencias.index', compact('emergencias'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
        return view('emergencias.create', compact('pacientes'));
    }

    public function store(Request $request)
{
    $request->validate([
        'paciente_id' => 'required|exists:pacientes,id',
        'nombre_paciente' => 'required|string|max:255',
        'numero_identificacion' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|string|max:50',
        'frecuencia_cardiaca' => 'required|integer',
        'frecuencia_respiratoria' => 'required|integer',
        'presion_arterial_sistolica' => 'required|integer',
        'saturacion_oxigeno' => 'required|integer',
        'nivel_conciencia' => 'required|string|max:50',
    ]);

    $datosTriaje = [
        'frecuencia_cardiaca' => $request->frecuencia_cardiaca,
        'frecuencia_respiratoria' => $request->frecuencia_respiratoria,
        'presion_arterial_sistolica' => $request->presion_arterial_sistolica,
        'saturacion_oxigeno' => $request->saturacion_oxigeno,
        'nivel_conciencia' => $request->nivel_conciencia,
        'puntaje' => $request->puntaje,
    ];


    $emergencia = Emergencia::create([
        'nombre_paciente' => $request->nombre_paciente,
        'numero_identificacion' => $request->numero_identificacion,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'genero' => $request->genero,
        'categoria' => $request->categoria,
    ]);

    $emergencia->triaje()->create($datosTriaje);

    return redirect()->route('emergencias.index')->with('success', 'Emergencia y triaje guardados correctamente.');
}


    public function show(Emergencia $emergencia)
    {
        return view('emergencias.show', compact('emergencia'));
    }

    public function edit(Emergencia $emergencia)
    {
        return view('emergencias.edit', compact('emergencia'));
    }

    public function update(Request $request, Emergencia $emergencia)
    {
        $request->validate([
            'nombre_paciente' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:20|unique:emergencias,numero_identificacion,' . $emergencia->id_emergencia . ',id_emergencia',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
        ]);

        $emergencia->update($request->all());
        return redirect()->route('emergencias.index')->with('success', 'Emergencia actualizada.');
    }

    public function destroy(Emergencia $emergencia)
    {
        $emergencia->delete();
        return redirect()->route('emergencias.index')->with('success', 'Emergencia eliminada.');
    }
}
