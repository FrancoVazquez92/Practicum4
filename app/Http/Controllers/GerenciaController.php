<?php

namespace App\Http\Controllers;

use App\Models\Gerencia;
use Illuminate\Http\Request;
use Psy\Command\HistoryCommand;

class GerenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $patients = Gerencia::all();
        return view('gerencia.index', compact('gerencia'));
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
    public function show(Gerencia $patient)
    {
        return view('gerencia.index', compact('gerencia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gerencia $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gerencia $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gerencia $patient)
    {
        //
    }
}
