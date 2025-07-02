<?php

namespace App\Http\Controllers;

use App\Services\HistorialMedicoService;
use Illuminate\Support\Facades\Auth;
use App\Models\Paciente;


class HistorialMedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:ver_historial');
    }

    public function historialPaciente($pacienteId, HistorialMedicoService $service)
    {
        $historial = $service->obtenerPorPaciente($pacienteId);

        return view('historial.index', compact('historial'));
    }    
    public function seleccionarPacienteMedico()
    {
        $medico = Auth::user()->medico;

        // Obtener pacientes que tengan atenciones médicas donde la cita fue con este médico
        $pacientes = Paciente::whereHas('citasmedicas.atencionMedica', function ($query) use ($medico) {
            $query->whereHas('cita', function ($q) use ($medico) {
                $q->where('medico_id', $medico->id);
            });
        })->with('usuario')->get();

        return view('historial.seleccionarPacienteMedico', compact('pacientes'));
    }
}
