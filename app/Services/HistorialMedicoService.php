<?php

namespace App\Services;

use App\Models\AtencionMedica;

class HistorialMedicoService
{
    /**
     * Obtener el historial médico de un paciente por su ID.
     */
    public function obtenerPorPaciente($pacienteId)
    {
        return AtencionMedica::whereHas('cita', function ($query) use ($pacienteId) {
                $query->where('paciente_id', $pacienteId);
            })
            ->with(['cita.medico.usuario'])
            ->orderByDesc('created_at')
            ->get();
    }
}
