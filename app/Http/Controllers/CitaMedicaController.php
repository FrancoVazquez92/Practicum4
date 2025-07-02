<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Agenda;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Notifications\CitaCreada;
use App\Notifications\CitaModificada;
use Illuminate\Validation\ValidationException;

class CitaMedicaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_citas|gestionar_citasAsignadas');
    }

    public function index(Paciente $paciente)
    {
        $citas = CitaMedica::where('paciente_id', $paciente->id)
            ->whereDoesntHave('atencionMedica') // 🔍 Citas sin atención médica
            ->with(['medico.usuario'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('citasmedicas.index', compact('citas', 'paciente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Paciente $paciente)
    {
        $medico = Medico::all();
        $agenda = Agenda::all();
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

        $cita = CitaMedica::create($data);

        // Notificar al médico
        $medico = $cita->medico;                   // Accedo al médico asignado
        $usuarioMedico = $medico->usuario;         // Accedo al usuario del médico
        $usuarioMedico->notify(new CitaCreada($cita)); // Envío la notificación con los datos de la cita


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
        $cita = CitaMedica::findOrFail($id);
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        $especialidades = Medico::distinct('especialidad')->pluck('especialidad');

        return view('citasmedicas.edit', compact('cita', 'pacientes', 'medicos', 'especialidades'));
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, $id)
    {
        $cita = CitaMedica::findOrFail($id);
        $cita->update($request->all());

        $rol = Auth::user()->rol->nombre;

        $usuarioMedico = $cita->medico->usuario;
        $usuarioPaciente = $cita->paciente->usuario;

        if ($rol === 'Medico') {
            // El médico edita → notificar al paciente
            $usuarioPaciente->notify(new CitaModificada($cita, 'editada', 'Medico'));
        } else {
            // El paciente edita → notificar al médico
            $usuarioMedico->notify(new CitaModificada($cita, 'editada', 'Paciente'));
        }

        return $rol === 'Medico'
            ? redirect()->route('citasmedicas.medico', $cita->medico_id)->with('success', 'Cita actualizada.')
            : redirect()->route('citasmedicas.index', $cita->paciente_id)->with('success', 'Cita actualizada.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cita = CitaMedica::findOrFail($id);

        $rol = Auth::user()->rol->nombre;

        $usuarioMedico = $cita->medico->usuario;
        $usuarioPaciente = $cita->paciente->usuario;

        // Notificar antes de eliminar
        if ($rol === 'Medico') {
            $usuarioPaciente->notify(new CitaModificada($cita, 'eliminada', 'Medico'));
        } else {
            $usuarioMedico->notify(new CitaModificada($cita, 'eliminada', 'Paciente'));
        }

        $pacienteId = $cita->paciente_id;
        $medicoId = $cita->medico_id;

        $cita->delete();

        return $rol === 'Medico'
            ? redirect()->route('citasmedicas.medico', $medicoId)->with('success', 'Cita eliminada.')
            : redirect()->route('citasmedicas.index', $pacienteId)->with('success', 'Cita eliminada.');
    }


    public function citasDelMedico(Medico $medico)
    {
        $citas = CitaMedica::where('medico_id', $medico->id)
            ->whereDoesntHave('atencionMedica') // 🔍 Citas sin atención médica
            ->with(['paciente.usuario'])
            ->orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('citasmedicas.medico', compact('citas', 'medico'));
    }

    public function detalles($id)
    {
        $cita = CitaMedica::with(['paciente.usuario', 'medico.usuario'])->find($id);

        if (!$cita) {
            return response()->json(['error' => 'Cita no encontrada'], 404);
        }

        return response()->json([
            'paciente' => [
                'nombre' => $cita->paciente->usuario->nombre,
                'apellido' => $cita->paciente->usuario->apellido,
            ],
            'medico' => [
                'nombre' => $cita->medico->usuario->nombre,
                'apellido' => $cita->medico->usuario->apellido,
            ]
        ]);
    }
    public function seleccionarPaciente()
    {   
        $pacientes = Paciente::with('usuario')->get();
        return view('citasmedicas.seleccionarPaciente', compact('pacientes'));
    }

}
