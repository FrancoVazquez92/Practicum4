<?php

namespace App\Services;

use App\Models\AtencionMedica;
use Illuminate\Support\Facades\Auth;

class HistorialMedicoService
{
    /**
     * Obtener el historial médico de un paciente por su ID.
     */

    public function obtenerPorPaciente($pacienteId)
    {
        $query = AtencionMedica::whereHas('cita', function ($q) use ($pacienteId) {
            $q->where('paciente_id', $pacienteId);
        })->with(['cita.medico.usuario', 'cita.paciente.usuario']);

        // Si el usuario autenticado es un médico, filtrar por su ID
        $user = Auth::user();
        if ($user->rol->nombre === 'Medico' && $user->medico) {
            $query->whereHas('cita', function ($q) use ($user) {
                $q->where('medico_id', $user->medico->id);
            });
        }

        return $query->orderByDesc('created_at')->get();
}

}



