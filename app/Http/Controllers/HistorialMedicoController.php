<?php

namespace App\Http\Controllers;

use App\Services\HistorialMedicoService;


class HistorialMedicoController extends Controller
{
    public function historialPaciente($pacienteId, HistorialMedicoService $service)
    {
        $historial = $service->obtenerPorPaciente($pacienteId);

        return view('historial.index', compact('historial'));
    }
}
