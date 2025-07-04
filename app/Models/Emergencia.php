<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergencia extends Model
{
    protected $primaryKey = 'id_emergencia';
    public $incrementing = true;
    protected $fillable = [
        'nombre_paciente',
        'numero_identificacion',
        'fecha_nacimiento',
        'genero',
        'categoria'
    ];

    public function triaje()
    {
        return $this->hasOne(Triaje::class, 'id_emergencia', 'id_emergencia');
    }
}

