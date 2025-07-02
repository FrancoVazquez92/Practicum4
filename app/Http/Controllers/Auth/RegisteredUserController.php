<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Models\Paciente;
use App\Models\Rol;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro.
     */
    public function create(): \Illuminate\View\View
    {
        return view('auth.register');
    }

    /**
     * Procesa el formulario de registro.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre'    => ['required', 'string', 'max:255'],
            'apellido'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:usuarios,email'],
            'contacto'  => ['required', 'string', 'max:20'],
            'direccion' => ['required', 'string'],
            'genero'    => ['required', 'in:masculino,femenino'],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Obtener el rol de paciente
        $rolPaciente = Rol::where('nombre', 'paciente')->firstOrFail();

        // Crear usuario
        $usuario = Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'contacto'  => $request->contacto,
            'password'  => Hash::make($request->password),
            'rol_id'    => $rolPaciente->id,
        ]);

        // Crear paciente vinculado al mismo ID
        Paciente::create([
            'id'        => $usuario->id,
            'direccion' => $request->direccion,
            'genero'    => $request->genero,
        ]);

        event(new Registered($usuario));
        Auth::login($usuario);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Registro exitoso');
    }
}

