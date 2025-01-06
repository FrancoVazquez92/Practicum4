<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CitaMedica extends Model
{
    use HasFactory;

    protected $fillable = [
        'idCita',
        'Estado',
        'Fecha',
        'Hora'
    ];
}
