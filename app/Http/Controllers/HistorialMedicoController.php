<?php

namespace App\Http\Controllers;

use App\Models\HistorialMedico;
use Illuminate\Http\Request;
use Psy\Command\HistoryCommand;

class HistorialMedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = HistorialMedico::all();
        return view('historialmedico.index', compact('historialmedico'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    
    }

    /**
     * Display the specified resource.
     */
    public function show(HistorialMedico $patient)
    {
        return view('historialmedico.index', compact('historialmedico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistorialMedico $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HistorialMedico $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistorialMedico $patient)
    {
        //
    }
}
