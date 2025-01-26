<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtencionMedica extends Model
{
    use HasFactory;

    protected $fillable = [
        'cita_medica_id',
        'paciente_nombre',
        'medico_nombre',
        'diagnostico',
        'tratamiento',
        'receta',
    ];

    public function citaMedica()
    {
        return $this->belongsTo(CitaMedica::class, 'cita_medica_id');
    }

    /**
     * Relación con Paciente
     */
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    /**
     * Relación con Medico
     */
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}
