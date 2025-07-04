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
