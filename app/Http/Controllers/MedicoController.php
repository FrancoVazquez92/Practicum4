<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Medico;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:gestionar_doctores');
    }

    public function index()
    {
        $medicos = Medico::with('usuario.rol')->get(); 
        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        $roles = Rol::where('nombre', 'medico')->firstOrFail();
        return view('medicos.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $roles = Rol::where('nombre', 'medico')->firstOrFail();

        $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'email'        => 'required|email|unique:usuarios,email',
            'contacto'     => 'required|string|max:15',
            'password'     => 'required|string|confirmed|min:6',
            'especialidad' => 'required|string|max:255',
        ]);

        // Crear el usuario base
        $usuario = Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'contacto'  => $request->contacto,
            'password'  => Hash::make($request->password),
            'rol_id'    => $roles->id,
        ]);

        // Crear el médico referenciando al usuario
        Medico::create([
            'id'           => $usuario->id,
            'especialidad' => $request->especialidad,
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico creado con éxito.');
    }

    public function edit(Medico $medico)
    {
        $roles = Rol::where('nombre', 'medico')->first();
        $usuario = $medico->usuario;
        return view('medicos.edit', compact('medico', 'usuario', 'roles'));
    }

    public function update(Request $request, Medico $medico)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'email'        => "required|email|unique:usuarios,email,{$medico->id}",
            'contacto'     => 'required|string|max:15',
            'especialidad' => 'required|string|max:255',
        ]);

        $usuario = $medico->usuario;
        $usuario->update([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'contacto'  => $request->contacto,
            'rol_id'    => $request->rol_id,
        ]);

        $medico->update([
            'especialidad' => $request->especialidad,
        ]);

        return redirect()->route('medicos.index')->with('success', 'Médico actualizado correctamente.');
    }

    public function show(Medico $medico)
    {
        return view('medicos.show', compact('medico'));
    }
    public function porEspecialidad($especialidad)
    {
        $medicos = Medico::with('usuario')
                    ->where('especialidad', $especialidad)
                    ->get();

        return response()->json($medicos);
    }
}