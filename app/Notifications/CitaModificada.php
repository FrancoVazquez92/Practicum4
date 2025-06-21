<?php

namespace App\Notifications;

use App\Models\CitaMedica;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CitaModificada extends Notification
{
    use Queueable;

    protected $cita;
    protected $accion; // 'editada' o 'eliminada'
    protected $actor;  // 'Paciente' o 'Medico'

    public function __construct(CitaMedica $cita, string $accion, string $actor)
    {
        $this->cita = $cita;
        $this->accion = $accion;
        $this->actor = $actor;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        // Para obtener el nombre del actor que ejecutó la acción
        $nombreActor = '';

        if ($this->actor === 'Paciente') {
            $nombreActor = $this->cita->paciente->usuario->nombre . ' ' . $this->cita->paciente->usuario->apellido;
        } elseif ($this->actor === 'Medico') {
            $nombreActor = $this->cita->medico->usuario->nombre . ' ' . $this->cita->medico->usuario->apellido;
        }

        return [
            'tipo' => 'cita',
            'mensaje' => "La cita fue {$this->accion} por el {$this->actor}: {$nombreActor}",
            'fecha' => $this->cita->fecha,
            'hora' => $this->cita->hora,
            'cita_id' => $this->cita->id,
            'medico_id' => $this->cita->medico_id,
            'paciente_id' => $this->cita->paciente_id,
        ];
    }
}
