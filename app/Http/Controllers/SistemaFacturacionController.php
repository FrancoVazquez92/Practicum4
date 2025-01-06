<?php

namespace App\Http\Controllers;

use App\Models\SistemaFacturacion;
use Illuminate\Http\Request;

class SistemaFacturacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = SistemaFacturacion::all();
        return view('sistemafacturacion.index', compact('sistemafacturacion'));
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
    public function show(SistemaFacturacion $patient)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SistemaFacturacion $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SistemaFacturacion $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SistemaFacturacion $patient)
    {
        //
    }
}
