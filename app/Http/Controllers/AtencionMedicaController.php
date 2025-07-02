<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\AtencionMedica;
use App\Models\CitaMedica;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;
use App\Notifications\HistorialActualizado;

class AtencionMedicaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_atenciones');
    }

    public function index(Medico $medico)
    {
        $medico = Auth::user()->medico;

        // Filtra atenciones cuya cita fue asignada al médico autenticado
        $atenciones = AtencionMedica::whereHas('cita', function ($query) use ($medico) {
            $query->where('medico_id', $medico->id);
        })
        ->with(['cita.paciente.usuario'])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('atencionmedicas.index', compact('atenciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarioId = Auth::id();

        $medico = Medico::find($usuarioId); 

        $citas = CitaMedica::where('medico_id', $medico->id)
                            //->whereDate('fecha', '>=', now()->toDateString()) esto es para validar que sean solo con fechas posteriores a hoy
                            ->whereDoesntHave('atencionMedica')
                            ->with('paciente.usuario')
                            ->orderBy('fecha')
                            ->orderBy('hora')
                            ->get();
        
        return view('atencionmedicas.create', compact('citas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {      

        $atencion = AtencionMedica::create($request->all());

        $pacienteUsuario = $atencion->cita->paciente->usuario;
        $pacienteUsuario->notify(new HistorialActualizado($atencion));

        return redirect()->route('atencionmedicas.index')->with('success', 'Atención médica registrada exitosamente');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $atenciones = AtencionMedica::with('paciente', 'medico')->findOrFail($id);

        return view('atencionmedicas.show', compact('atenciones'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $atencion = AtencionMedica::with('paciente', 'medico')->findOrFail($id); // Obtiene la cita médica por ID
        $citas = CitaMedica::all(); // Lista de pacientes
        $pacientes = Paciente::all(); // Lista de pacientes
        $medicos = Medico::all(); // Lista de médicos

        return view('atencionmedicas.edit', compact('atencion', 'citas', 'pacientes', 'medicos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $atencion = AtencionMedica::findOrFail($id);
        $atencion->update($request->all());

        $pacienteUsuario = $atencion->cita->paciente->usuario;
        $pacienteUsuario->notify(new HistorialActualizado($atencion));

        return redirect()->route('atencionmedicas.index')->with('success','Atencion Medica actualiza satisfactoriamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $atencion = AtencionMedica::findOrFail($id); // ✅ Esto busca en la tabla correcta
        $atencion->delete();

        $pacienteUsuario = $atencion->cita->paciente->usuario;
        $pacienteUsuario->notify(new HistorialActualizado($atencion));

        return redirect()->route('atencionmedicas.index')->with('success', 'Atención médica eliminada correctamente.');
    }
}
