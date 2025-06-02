<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the usuario's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'usuario' => $request->usuario(),
        ]);
    }

    /**
     * Update the usuario's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->ususario()->fill($request->validated());

        if ($request->usuario()->isDirty('email')) {
            $request->usuario()->email_verified_at = null;
        }

        $request->usuario()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the usuario's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('usuarioDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $usuario = $request->usuario();

        Auth::logout();

        $usuario->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function show()
    {
        $usuario = Auth::usuario();
        return view('profile.show', compact('usuario'));
    }
}
