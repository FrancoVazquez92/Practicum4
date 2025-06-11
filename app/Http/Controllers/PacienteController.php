<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Paciente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::with('usuario.rol')->get(); 
        return view('pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        $roles = Rol::where('nombre', 'paciente')->firstOrFail();
        return view('pacientes.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $rol = Rol::where('nombre', 'paciente')->firstOrFail();

        $request->validate([
            'nombre'    => 'required|string|max:255',
            'apellido'  => 'required|string|max:255',
            'email'     => 'required|email|unique:usuarios,email',
            'contacto'  => 'required|string|max:15',
            'password'  => 'required|string|confirmed|min:6',
            'direccion' => 'required|string|max:255',
            'genero' => 'required|in:masculino,femenino',

        ]);

        // Crear el usuario
        $usuario = Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'contacto'  => $request->contacto,
            'password'  => Hash::make($request->password),
            'rol_id'    => $rol->id,
        ]);

        // Crear el paciente
        Paciente::create([
            'id'        => $usuario->id,
            'direccion' => $request->direccion,
            'genero'    => $request->genero,
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente creado con éxito.');
    }

    public function edit(Paciente $paciente)
    {
        $rol = Rol::where('nombre', 'paciente')->first();
        $usuario = $paciente->usuario;
        return view('pacientes.edit', compact('paciente', 'usuario', 'rol'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'apellido'  => 'required|string|max:255',
            'email'     => "required|email|unique:usuarios,email,{$paciente->id}",
            'contacto'  => 'required|string|max:15',
            'direccion' => 'required|string|max:255',
            'genero' => 'required|in:masculino,femenino',

        ]);

        $usuario = $paciente->usuario;
        $usuario->update([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'contacto'  => $request->contacto,
        ]);

        $paciente->update([
            'direccion' => $request->direccion,
            'genero'    => $request->genero,
        ]);

        return redirect()->route('pacientes.index')->with('success', 'Paciente actualizado correctamente.');
    }

    public function show(Paciente $paciente)
    {
        return view('pacientes.show', compact('paciente'));
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->usuario()->delete();
        $paciente->delete();

        return redirect()->route('pacientes.index')->with('success', 'Paciente eliminado.');
    }
}
