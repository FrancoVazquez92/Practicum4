<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'direccion', 'genero','numero_identificacion', 'fecha_nacimiento',];
    
    // otros campos que tengas

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
    public function citasmedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }
    public function atencionMedica()
    {
        return $this->hasMany(AtencionMedica::class);
    }
}