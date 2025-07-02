<?php   

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Medico;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\CitaMedica;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_disponibilidad')->except('fechasDisponibles','horariosDisponibles');
    }
    public function index(Medico $medico)
    {
        return view('agendas.index', compact('medico'));
    }

    public function create(Medico $medico)
    {
        return view('agendas.create', compact('medico'));
    }

    public function store(Request $request, Medico $medico)
    {
        $request->validate([
            'dia'         => 'required|date',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin'    => 'required|date_format:H:i|after:hora_inicio',
        ]);

        $fecha = $request->input('dia');
        $horaInicio = $request->input('hora_inicio');

        $fechaHoraInicio = Carbon::createFromFormat('Y-m-d H:i', "{$fecha} {$horaInicio}");
        $ahora = Carbon::now();

        // Si la fecha es hoy, valido que la hora de inicio sea al menos 30 min después de ahora
        if ($fechaHoraInicio->isToday() && $fechaHoraInicio->lt($ahora->copy()->addMinutes(30))) {
            return back()->withErrors(['hora_inicio' => 'La hora de inicio debe ser al menos 30 minutos después de la hora actual.'])->withInput();
        }

        // Si la fecha es anterior a hoy, no permito
        if ($fechaHoraInicio->isPast() && !$fechaHoraInicio->isToday()) {
            return back()->withErrors(['dia' => 'No puedes registrar disponibilidad para fechas pasadas.'])->withInput();
        }

        Agenda::create([
            'medico_id'   => $medico->id,
            'dia'         => $request->dia,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin'    => $request->hora_fin,
        ]);

        return redirect()->route('agendas.index', $medico)->with('success', 'Disponibilidad registrada.');
    }


    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $medicoId = $agenda->medico_id;
        $agenda->delete();

        return redirect()->route('agendas.index', $medicoId)->with('success', 'Disponibilidad eliminada.');
    }

    public function fechasDisponibles($medicoId)
    {
        $fechas = Agenda::where('medico_id', $medicoId)
            ->whereDate('dia', '>=', Carbon::today())
            ->select('dia')
            ->distinct()
            ->orderBy('dia')
            ->pluck('dia');

        return response()->json($fechas);

    }

    public function horariosDisponibles($medicoId, $fecha)
    {
        $agendas = Agenda::where('medico_id', $medicoId)
            ->whereDate('dia', $fecha)
            ->get();

        if ($agendas->isEmpty()) {
            return response()->json([]);
        }

        $intervalos = [];
        $hoy = Carbon::today()->toDateString();
        $horaActual = Carbon::now()->format('H:i');

        foreach ($agendas as $agenda) {
            $inicio = Carbon::createFromFormat('H:i:s', $agenda->hora_inicio);
            $fin = Carbon::createFromFormat('H:i:s', $agenda->hora_fin);

            while ($inicio < $fin) {
                $horaFormateada = $inicio->format('H:i');

                // Si la fecha es hoy, solo permitir horas mayores a la actual
                if ($fecha > $hoy || $horaFormateada > $horaActual) {
                    $intervalos[] = $horaFormateada;
                }

                $inicio->addMinutes(30);
            }
        }

        $ocupadas = CitaMedica::where('medico_id', $medicoId)
            ->whereDate('fecha', $fecha)
            ->pluck('hora')
            ->map(fn($hora) => Carbon::createFromFormat('H:i:s', $hora)->format('H:i'))
            ->toArray();

        $disponibles = array_values(array_diff($intervalos, $ocupadas));
        $disponibles = array_unique($disponibles);
        sort($disponibles);

        return response()->json($disponibles);
    }

    public function seleccionarMedico()
    {   
        $medicos = Medico::with('usuario')->get();
        return view('agendas.seleccionarMedico', compact('medicos'));
    }
}
