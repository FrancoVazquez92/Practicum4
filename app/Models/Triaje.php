<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Triaje extends Model
{
    protected $fillable = [
        'id_emergencia',
        'frecuencia_cardiaca',
        'frecuencia_respiratoria',
        'presion_arterial_sistolica',
        'saturacion_oxigeno',
        'nivel_conciencia',
    ];

    public function emergencia()
    {
        return $this->belongsTo(Emergencia::class, 'id_emergencia', 'id_emergencia');
    }
}
