<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Administrador;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdministradorController extends Controller
{
    public function index()
    {
        
        $administradores = Administrador::with('usuario.rol')->get(); 
        return view('administradores.index', compact('administradores'));
        
    }

    public function create()
    {
        $roles = Rol::where('nombre', 'administrador')->firstOrFail();
        return view('administradores.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = Rol::where('nombre', 'administrador')->firstOrFail();
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'contacto' => 'required|string|max:15',
            'password' => 'required|string|confirmed|min:6',
            
        ]);

        // Crear el usuario base
        $usuario = Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'contacto'  => $request->contacto,
            'password'  => Hash::make($request->password),
            'rol_id'    => $request->rol_id,
        ]);

        // Crear la secretaria referenciando al usuario
        Administrador::create([
            'id' => $usuario->id,
        ]);

        return redirect()->route('administradores.index')->with('success', 'Administrador creada con éxito.');
    }

    public function edit(Administrador $administrador)
    {
        $roles = Rol::where('nombre', 'administrador')->first();
        $usuario = $administrador->usuario;
        return view('administradores.edit', compact('administrador', 'usuario', 'roles'));
    }

    public function update(Request $request, Administrador $administrador)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => "required|email|unique:usuarios,email,{$administrador->id}",
            'contacto' => 'required|string|max:15',
        ]);

        $usuario = $administrador->usuario;
        $usuario->update([
            'nombre'   => $request->nombre,
            'apellido'=> $request->apellido,
            'email'    => $request->email,
            'contacto' => $request->contacto,
            'rol_id'   => $request->rol_id,
        ]);

        return redirect()->route('administradores.index')->with('success', 'Administrador actualizada correctamente.');
    }

    public function destroy(Administrador $administrador)
    {
        // Elimina también el usuario relacionado
        $administrador->usuario()->delete();
        $administrador->delete();

        return redirect()->route('administradores.index')->with('success', 'Administrador eliminado.');
    }

    public function show(Administrador $administrador)
    {
        return view('administradores.show', compact('administrador'));
    }
    
}
