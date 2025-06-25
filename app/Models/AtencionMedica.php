<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtencionMedica extends Model
{
    use HasFactory;

    protected $fillable = [
        'diagnostico',
        'enfermedad',
        'cita_medica_id',        
        'medico_nombre',
        'paciente_nombre',
        'tratamiento',
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
    public function cita()
    {
        return $this->belongsTo(CitaMedica::class, 'cita_medica_id');
    }

}
