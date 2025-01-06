<?php

namespace App\Http\Controllers;

use App\Models\CitaMedica;
use Illuminate\Http\Request;

class CitaMedicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = CitaMedica::all();
        return view('citamedica.index', compact('citamedica'));
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
    public function show(CitaMedica $patient)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CitaMedica $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CitaMedica $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CitaMedica $patient)
    {
        //
    }
}
