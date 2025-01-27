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
        return $this->belongsTo(CitaMedica::class);
    }
    public function Paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
    public function Medico()
    {
        return $this->belongsTo(Medico::class);
    }
}
