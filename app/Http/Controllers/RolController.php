<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return view('rols.index', compact('roles'));
    }

    public function create()
    {
        return view('rols.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'permisos' => 'nullable|string',
        ]);

        Rol::create($request->all());

        return redirect()->route('rols.index')->with('success', 'Rol creado exitosamente');
    }

    public function edit(Rol $rol)
    {
        return view('rols.edit', compact('rol'));
    }

    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'permisos' => 'nullable|string',
        ]);

        $rol->update($request->all());

        return redirect()->route('rols.index')->with('success', 'Rol actualizado correctamente');
    }

    public function destroy(Rol $rol)
    {
        $rol->delete();

        return redirect()->route('rols.index')->with('success', 'Rol eliminado');
    }
}

