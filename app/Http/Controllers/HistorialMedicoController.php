<?php

namespace App\Http\Controllers;

use App\Services\HistorialMedicoService;


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
}
