<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'paciente_id',
        'medico_id',
        'fecha',
        'hora',
    ];

    // Relación con el modelo Paciente
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'paciente_id');
    }

    // Relación con el modelo Medico
    public function medico()
    {
        return $this->belongsTo(Medico::class, 'medico_id');
    }
}
