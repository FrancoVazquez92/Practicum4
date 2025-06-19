<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Paciente $paciente)
    {
        return view('citasmedicas.index', compact('paciente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paciente $paciente, Medico $medico, Agenda $agenda)
    {
        $especialidades = Medico::distinct('especialidad')->pluck('especialidad'); 

        return view('citasmedicas.create', compact('paciente', 'medico', 'agenda', 'especialidades'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Paciente $paciente)
    {
        $request->validate([
            'medico_id' => 'required|exists:medicos,id',
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i',
        ]);

        $data = $request->all();
        $data['paciente_id'] = $paciente->id;

        CitaMedica::create($data);

        return redirect()->route('citasmedicas.index', $paciente)
                        ->with('success', 'Cita médica creada exitosamente.');
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

        // Verifica el rol del usuario autenticado
        $rol = Auth::user()->rol->nombre;

        if ($rol === 'Medico') {
            return redirect()
                ->route('citasmedicas.medico', $cita->medico_id)
                ->with('success', 'Cita médica actualizada satisfactoriamente.');
        }

        return redirect()
            ->route('citasmedicas.index', $cita->paciente_id)
            ->with('success', 'Cita médica actualizada satisfactoriamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar la cita médica por ID
        $cita = CitaMedica::findOrFail($id);

        // Opcional: guardar el paciente para la redirección
        $pacienteId = $cita->paciente_id;

        // Eliminar la cita médica
        $cita->delete();

        // Redirigir a la lista de citas del paciente con mensaje de éxito
        return redirect()->route('citasmedicas.index', $pacienteId)
                        ->with('success', 'Cita médica eliminada correctamente.');
    }

    public function detalles($id)
    {
        $cita = CitaMedica::with(['paciente', 'medico'])->findOrFail($id);

        return response()->json([
            'paciente' => $cita->paciente,
            'medico' => $cita->medico,
        ]);
    }
    public function citasDelMedico(Medico $medico)
    {
        $citas = CitaMedica::where('medico_id', $medico->id)
                    ->with(['paciente.usuario'])
                    ->orderBy('fecha')
                    ->orderBy('hora')
                    ->get();

        return view('citasmedicas.medico', compact('citas', 'medico'));
    }
}
