<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nombre'    => ['required', 'string', 'max:255'],
            'apellido'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:usuarios,email'],
            'contacto'  => ['required', 'string', 'max:20'], 
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'rol_id'    => ['required', 'integer'],
        ]);

        $usuario = Usuario::create([
            'nombre'    => $request->nombre,
            'apellido'  => $request->apellido,
            'email'     => $request->email,
            'contacto'  => $request->contacto,
            'password'  => Hash::make($request->password),
            'rol_id'    => $request->rol_id,
        ]);

        event(new Registered($usuario));

        Auth::login($usuario);

        return redirect(RouteServiceProvider::HOME);
    }
}
