<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medico extends Model
{
    protected $table = 'medicos';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id', 'especialidad'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
    

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }
    public function citasMedicas()
    {
        return $this->hasMany(CitaMedica::class);
    }


}

