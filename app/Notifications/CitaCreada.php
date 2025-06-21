<?php

namespace App\Notifications;

use App\Models\CitaMedica;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;

class CitaCreada extends Notification
{
    use Queueable;

    protected $cita;

    public function __construct(CitaMedica $cita)
    {
        $this->cita = $cita;
    }

    public function via($notifiable)
    {
        return ['database']; // Usa la base de datos
    }

    public function toDatabase($notifiable)
    {
        return [
            'tipo' => 'cita',
            'mensaje' => 'Nueva cita agendada por el paciente: ' . $this->cita->paciente->usuario->nombre . ' ' . $this->cita->paciente->usuario->apellido,
            'fecha' => $this->cita->fecha,
            'hora' => $this->cita->hora,
            'cita_id' => $this->cita->id,
            'medico_id' => $this->cita->medico_id,
            'paciente_id' => $this->cita->paciente_id,
        ];
    }
}

