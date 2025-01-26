<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula',
        'nombre',
        'apellido',
        'telefono',
        'direccion',
        'correoelectronico'
    ];
    public function citas()
    {
        return $this->hasMany(CitaMedica::class, 'paciente_id');
    }

    
}


