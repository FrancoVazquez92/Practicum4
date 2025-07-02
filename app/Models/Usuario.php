<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'contacto',
        'password',
        'rol_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function paciente()
    {
        return $this->hasOne(Paciente::class);
    }

    public function medico()
    {
        return $this->hasOne(Medico::class, 'id'); 
    }

    public function gerencia()
    {
        return $this->hasOne(Gerencia::class);
    }

    public function secretaria()
    {
        return $this->hasOne(Secretaria::class);
    }

    public function administrador()
    {
        return $this->hasOne(Administrador::class);
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

}
