<?php

namespace App\Http\Controllers;



use App\Models\Emergencia;
use App\Models\Triaje;
use App\Models\Paciente;
use Illuminate\Http\Request;

class EmergenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_emergencias');
    }
    public function index()
    {
        $emergencias = Emergencia::all();
        return view('emergencias.index', compact('emergencias'));
    }

    public function create()
    {
        $pacientes = Paciente::all();
        return view('emergencias.create', compact('pacientes'));
    }

    public function store(Request $request)
{
    $request->validate([
        'paciente_id' => 'required|exists:pacientes,id',
        'nombre_paciente' => 'required|string|max:255',
        'numero_identificacion' => 'required|string|max:255',
        'fecha_nacimiento' => 'required|date',
        'genero' => 'required|string|max:50',
        'frecuencia_cardiaca' => 'required|integer',
        'frecuencia_respiratoria' => 'required|integer',
        'presion_arterial_sistolica' => 'required|integer',
        'saturacion_oxigeno' => 'required|integer',
        'nivel_conciencia' => 'required|string|max:50',
    ]);

    $datosTriaje = [
        'frecuencia_cardiaca' => $request->frecuencia_cardiaca,
        'frecuencia_respiratoria' => $request->frecuencia_respiratoria,
        'presion_arterial_sistolica' => $request->presion_arterial_sistolica,
        'saturacion_oxigeno' => $request->saturacion_oxigeno,
        'nivel_conciencia' => $request->nivel_conciencia,
    ];

    $resultado = $this->calcularPuntajeTriaje($datosTriaje);

    $emergencia = Emergencia::create([
        'nombre_paciente' => $request->nombre_paciente,
        'numero_identificacion' => $request->numero_identificacion,
        'fecha_nacimiento' => $request->fecha_nacimiento,
        'genero' => $request->genero,
        'categoria' => $resultado['categoria'], // Guardamos la categoría calculada
    ]);

    $emergencia->triaje()->create($datosTriaje);

    return redirect()->route('emergencias.index')->with('success', 'Emergencia y triaje guardados correctamente.');
}


    private function calcularPuntajeTriaje(array $datos)
    {
        // Inicializar puntaje
        $puntajeTotal = 0;

        // Frecuencia Cardíaca (latidos/min)
        $fc = $datos['frecuencia_cardiaca'];
        if (($fc >= 60 && $fc <= 100)) {
            $puntajeTotal += 0; // Normal
        } elseif (($fc >= 100 && $fc <= 120) || ($fc >= 50 && $fc < 60)) {
            $puntajeTotal += 1; // Alerta Moderada
        } elseif (($fc >= 121 && $fc <= 140) || ($fc >= 40 && $fc < 50)) {
            $puntajeTotal += 3; // Alerta Severa
        } else { // >140 o <40
            $puntajeTotal += 5; // Crítico
        }

        // Frecuencia Respiratoria (respiraciones/min)
        $fr = $datos['frecuencia_respiratoria'];
        if ($fr >= 12 && $fr <= 20) {
            $puntajeTotal += 0;
        } elseif (($fr >= 21 && $fr <= 24) || ($fr >= 9 && $fr <= 11)) {
            $puntajeTotal += 1;
        } elseif (($fr >= 25 && $fr <= 30) || ($fr >= 6 && $fr <= 8)) {
            $puntajeTotal += 3;
        } else { // >30 o <6
            $puntajeTotal += 5;
        }

        // Presión Arterial Sistólica (mmHg)
        $pa = $datos['presion_arterial_sistolica'];
        if ($pa >= 90 && $pa <= 140) {
            $puntajeTotal += 0;
        } elseif (($pa >= 140 && $pa <= 160) || ($pa >= 80 && $pa < 90)) {
            $puntajeTotal += 1;
        } elseif (($pa >= 161 && $pa <= 180) || ($pa >= 70 && $pa < 80)) {
            $puntajeTotal += 3;
        } else { // >180 o <70
            $puntajeTotal += 5;
        }

        // Saturación de Oxígeno (%)
        $spo2 = $datos['saturacion_oxigeno'];
        if ($spo2 >= 95) {
            $puntajeTotal += 0;
        } elseif ($spo2 >= 90 && $spo2 <= 94) {
            $puntajeTotal += 1;
        } elseif ($spo2 >= 85 && $spo2 <= 89) {
            $puntajeTotal += 3;
        } else { // <85
            $puntajeTotal += 5;
        }

        // Nivel de Conciencia (AVPU)
        // Valores: 'Alerta', 'Verbal', 'Dolor', 'Inconsciente'
        $nivel = strtolower($datos['nivel_conciencia']);
        if ($nivel == 'alerta') {
            $puntajeTotal += 0;
        } elseif ($nivel == 'verbal' || $nivel == 'responde a voz') {
            $puntajeTotal += 1;
        } elseif ($nivel == 'dolor' || $nivel == 'responde al dolor') {
            $puntajeTotal += 3;
        } else { // 'inconsciente' o 'no responde'
            $puntajeTotal += 5;
        }

        // Determinar categoría según suma total
        if ($puntajeTotal <= 4) {
            $categoria = 'Verde'; // No urgente
        } elseif ($puntajeTotal <= 9) {
            $categoria = 'Amarillo'; // Urgente
        } elseif ($puntajeTotal <= 14) {
            $categoria = 'Naranja'; // Muy urgente
        } else {
            $categoria = 'Rojo'; // Emergencia
        }

        return ['puntaje' => $puntajeTotal, 'categoria' => $categoria];
    }



    public function show(Emergencia $emergencia)
    {
        return view('emergencias.show', compact('emergencia'));
    }

    public function edit(Emergencia $emergencia)
    {
        return view('emergencias.edit', compact('emergencia'));
    }

    public function update(Request $request, Emergencia $emergencia)
    {
        $request->validate([
            'nombre_paciente' => 'required|string|max:255',
            'numero_identificacion' => 'required|string|max:20|unique:emergencias,numero_identificacion,' . $emergencia->id_emergencia . ',id_emergencia',
            'fecha_nacimiento' => 'required|date',
            'genero' => 'required|in:Masculino,Femenino,Otro',
        ]);

        $emergencia->update($request->all());
        return redirect()->route('emergencias.index')->with('success', 'Emergencia actualizada.');
    }

    public function destroy(Emergencia $emergencia)
    {
        $emergencia->delete();
        return redirect()->route('emergencias.index')->with('success', 'Emergencia eliminada.');
    }
}
