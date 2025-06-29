<?php   

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Medico;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_disponibilidad');
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
            ->orderBy('dia')
            ->pluck('dia');

        return response()->json($fechas);
    }

    public function horariosDisponibles($medicoId, $fecha)
    {
        // Buscar la agenda del médico para esa fecha
        $agenda = Agenda::where('medico_id', $medicoId)
                        ->whereDate('dia', $fecha)
                        ->first();

        if (!$agenda) {
            return response()->json([]);
        }

        $horaInicio = Carbon::parse($agenda->hora_inicio);
        $horaFin = Carbon::parse($agenda->hora_fin);
        $horarios = [];

        while ($horaInicio < $horaFin) {
            $horarios[] = $horaInicio->format('H:i');
            $horaInicio->addMinutes(30);
        }

        return response()->json($horarios);
    }


}
