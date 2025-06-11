<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    protected $table = 'administradores';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
}
