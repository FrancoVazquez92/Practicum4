<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialMedico extends Model
{
    use HasFactory;

    protected $fillable = [
        'idHistorial',
        'Fecha Actualizacion',
        'Diagnostico',
        'Tratamiento'
    ];
}
