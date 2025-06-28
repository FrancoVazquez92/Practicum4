<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    // Lista de permisos disponibles
    private $permisosDisponibles = [
        'ver_dashboard' => 'Ver Dashboard',
        'gestionar_citas' => 'Gestionar Citas',
        'ver_historial' => 'Ver Historial Médico',
        'gestionar_usuarios' => 'Gestionar Usuarios',
    ];

    public function index()
    {
        $roles = Rol::all();
        return view('rols.index', compact('roles'));
    }

    public function create()
    {
        $permisosDisponibles = $this->permisosDisponibles;
        return view('rols.create', compact('permisosDisponibles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'permisos' => 'nullable|array',
        ]);

        Rol::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'permisos' => json_encode($request->permisos), // ✅ codifica como JSON
        ]);

        return redirect()->route('rols.index')->with('success', 'Rol creado exitosamente');
    }


    public function edit(Rol $rol)
    {
        $permisosSeleccionados = explode(',', $rol->permisos ?? '');
        $permisosDisponibles = $this->permisosDisponibles;

        return view('rols.edit', compact('rol', 'permisosSeleccionados', 'permisosDisponibles'));
    }

    public function update(Request $request, Rol $rol)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'permisos' => 'nullable|array',
        ]);

        $rol->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'permisos' => json_encode($request->permisos), // ✅ codifica como JSON
        ]);

        return redirect()->route('rols.index')->with('success', 'Rol actualizado correctamente');
    }


    public function destroy(Rol $rol)
    {
        $rol->delete();
        return redirect()->route('rols.index')->with('success', 'Rol eliminado');
    }
    public function show(Rol $rol)
    {
        return view('rols.show', compact('rol'));
    }
}

