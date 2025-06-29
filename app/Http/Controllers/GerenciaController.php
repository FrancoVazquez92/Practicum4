<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Gerencia;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GerenciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_gerencia');
    }

    public function index()
    {
        $gerencias = Gerencia::with('usuario.rol')->get(); 
        return view('gerencias.index', compact('gerencias'));
    }

    public function create()
    {
        $roles = Rol::where('nombre', 'gerencia')->firstOrFail();
        return view('gerencias.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = Rol::where('nombre', 'gerencia')->firstOrFail();
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
        Gerencia::create([
            'id' => $usuario->id,
        ]);

        return redirect()->route('gerencias.index')->with('success', 'Gerente creado con éxito.');
    }

    public function edit(Gerencia $gerencia)
    {
        $roles = Rol::where('nombre', 'gerencia')->first();
        $usuario = $gerencia->usuario;
        return view('gerencias.edit', compact('gerencia', 'usuario', 'roles'));
    }

    public function update(Request $request, Gerencia $gerencia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => "required|email|unique:usuarios,email,{$gerencia->id}",
            'contacto' => 'required|string|max:15',
        ]);

        $usuario = $gerencia->usuario;
        $usuario->update([
            'nombre'   => $request->nombre,
            'apellido'=> $request->apellido,
            'email'    => $request->email,
            'contacto' => $request->contacto,
            'rol_id'   => $request->rol_id,
        ]);

        return redirect()->route('gerencias.index')->with('success', 'Gerente actualizada correctamente.');
    }

    public function destroy(Gerencia $gerencia)
    {
        // Elimina también el usuario relacionado
        $gerencia->usuario()->delete();
        $gerencia->delete();

        return redirect()->route('gerencias.index')->with('success', 'Gerente eliminado.');
    }

    public function show(Gerencia $gerencia)
    {
        return view('gerencias.show', compact('gerencia'));
    }
    
}