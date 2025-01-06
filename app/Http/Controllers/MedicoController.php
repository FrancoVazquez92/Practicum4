<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;

class MedicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Medico::all();
        return view('medico.index', compact('medico'));
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
    public function show(Medico $patient)
    {
 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medico $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medico $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medico $patient)
    {
        //
    }
}
