<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\CitaMedica;
use App\Models\Usuario;
use App\Models\Medico;
use App\Models\Paciente;

class DashboardController extends Controller
{

    public function index()
    {
        $citasPorMes = CitaMedica::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
                        ->groupBy('mes')
                        ->orderBy('mes')
                        ->get()
                        ->map(function ($item) {
                            $item->mes_nombre = Carbon::create()->month($item->mes)->locale('es')->translatedFormat('F');
                            return $item;
                        });


        return view('dashboard.index', [
            'totalCitas' => CitaMedica::count(),
            'citasHoy' => CitaMedica::whereDate('fecha', today())->count(),
            'pacientes' => Paciente::count(),
            'medicos' => Medico::count(),
            'citasPorMes' => $citasPorMes
        ]);
    }

}
