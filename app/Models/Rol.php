<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Rol extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'permisos'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
    
}
