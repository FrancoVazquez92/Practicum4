<?php

namespace App\Http\Controllers;

use App\Models\Triaje;
use Illuminate\Http\Request;

class TriajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'frecuencia_cardiaca' => 'required|numeric',
            'frecuencia_respiratoria' => 'required|numeric',
            'presion_arterial_sistolica' => 'required|numeric',
            'saturacion_oxigeno' => 'required|numeric',
            'nivel_conciencia' => 'required|string',
            'id_emergencia' => 'required|exists:emergencias,id_emergencia',
        ]);

        Triaje::create($request->all());

        return redirect()->route('emergencias.index')->with('success', 'Triaje registrado exitosamente.');
    }

    public function calcular(Request $request)
    {
        $datos = $request->only([
            'frecuencia_cardiaca',
            'frecuencia_respiratoria',
            'presion_arterial_sistolica',
            'saturacion_oxigeno',
            'nivel_conciencia'
        ]);

        $resultado = $this->calcularPuntajeTriaje($datos);

        return response()->json($resultado);
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

    /**
     * Display the specified resource.
     */
    public function show(Triaje $triaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Triaje $triaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Triaje $triaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Triaje $triaje)
    {
        //
    }
}
