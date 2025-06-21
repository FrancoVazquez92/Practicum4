<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function marcarComoLeida($id)
    {
        $usuario = Auth::user();
        $notificacion = $usuario->unreadNotifications()->find($id);

        if ($notificacion) {
            $notificacion->markAsRead();

            $data = $notificacion->data;

            if (isset($data['tipo']) && $data['tipo'] === 'cita') {
                // Redirigir según el rol del usuario
                $rol = $usuario->rol->nombre;

                if ($rol === 'Medico') {
                    return redirect()->route('citasmedicas.medico', $data['medico_id']);
                } elseif ($rol === 'Paciente') {
                    return redirect()->route('citasmedicas.index', $data['paciente_id']);
                }
            }
        }

        // Si no cumple condiciones, simplemente regresa
        return back();
    }
}
