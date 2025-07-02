<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\CitaMedica;
use App\Models\Agenda;
use App\Models\Medico;
use App\Models\Paciente;
use App\Models\AtencionMedica;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:ver_dashboard');
    }

    public function index()
    {
        
        $alertas = [];

        $totalCitasHoy = CitaMedica::whereDate('fecha', today())->count();

        if ($totalCitasHoy == 0) {
            $alertas[] = "🔴 Atención: Hay $totalCitasHoy citas programadas para hoy.";
        }
        
        $hoy = Carbon::today();
        $proximosDias = Carbon::today()->addDays(1);

        // Verifico si hay registros en la tabla de agenda médica en los próximos días
        $disponibilidadActiva = Agenda::whereBetween('dia', [$hoy, $proximosDias])->exists();

        if (!$disponibilidadActiva) {
            $alertas[] = "⚠️ No hay disponibilidad médica registrada. Los pacientes no podrán agendar citas.";
        }

        $inicioSemana = Carbon::now()->startOfWeek(); // lunes
        $finSemana = Carbon::now()->endOfWeek();     // domingo

        $nuevosPacientesSemana = Paciente::whereBetween('created_at', [$inicioSemana, $finSemana])->count();

        if ($nuevosPacientesSemana > 0) {
            $alertas[] = "👥 Se han registrado $nuevosPacientesSemana nuevos pacientes esta semana.";
        }

        $atencionesSemana = AtencionMedica::whereBetween('created_at', [$inicioSemana, $finSemana])->count();
        $alertas[] = "👥 Se han registrado $atencionesSemana nuevas atenciones medicas esta semana.";

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
            'citasHoy' => $totalCitasHoy,
            'pacientes' => Paciente::count(),
            'medicos' => Medico::count(),
            'citasPorMes' => $citasPorMes,
            'alertas' => $alertas,
        ]);
    }
}
