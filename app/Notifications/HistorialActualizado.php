<?php

namespace App\Notifications;

use App\Models\AtencionMedica;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class HistorialActualizado extends Notification
{
    use Queueable;

    protected $atencion;

    public function __construct(AtencionMedica $atencion)
    {
        $this->atencion = $atencion;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'mensaje' => 'Tu historial médico ha sido actualizado por el Dr. ' . $this->atencion->cita->medico->usuario->nombre . ' ' . $this->atencion->cita->medico->usuario->apellido,
            'fecha' => $this->atencion->created_at->format('Y-m-d'),
            'hora' => $this->atencion->created_at->format('H:i'),
            'tipo' => 'historial',
            'paciente_id' => $this->atencion->cita->paciente_id,
        ];
    }
}
