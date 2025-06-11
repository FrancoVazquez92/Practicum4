<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'direccion', 'genero'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
}