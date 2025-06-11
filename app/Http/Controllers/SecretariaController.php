<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Secretaria;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{
    public function index()
    {
        $secretarias = Secretaria::with('usuario.rol')->get(); 
        return view('secretarias.index', compact('secretarias'));
    }

    public function create()
    {
        $roles = Rol::where('nombre', 'secretaria')->firstOrFail();
        return view('secretarias.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = Rol::where('nombre', 'secretaria')->firstOrFail();
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
        Secretaria::create([
            'id' => $usuario->id,
        ]);

        return redirect()->route('secretarias.index')->with('success', 'Secretaria creada con éxito.');
    }

    public function edit(Secretaria $secretaria)
    {
        $roles = Rol::where('nombre', 'secretaria')->first();
        $usuario = $secretaria->usuario;
        return view('secretarias.edit', compact('secretaria', 'usuario', 'roles'));
    }

    public function update(Request $request, Secretaria $secretaria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => "required|email|unique:usuarios,email,{$secretaria->id}",
            'contacto' => 'required|string|max:15',
        ]);

        $usuario = $secretaria->usuario;
        $usuario->update([
            'nombre'   => $request->nombre,
            'apellido'=> $request->apellido,
            'email'    => $request->email,
            'contacto' => $request->contacto,
            'rol_id'   => $request->rol_id,
        ]);

        return redirect()->route('secretarias.index')->with('success', 'Secretaria actualizada correctamente.');
    }

    public function destroy(Secretaria $secretaria)
    {
        // Elimina también el usuario relacionado
        $secretaria->usuario()->delete();
        $secretaria->delete();

        return redirect()->route('secretarias.index')->with('success', 'Secretaria eliminada.');
    }

    public function show(Secretaria $secretaria)
    {
        return view('secretarias.show', compact('secretaria'));
    }
    
}
