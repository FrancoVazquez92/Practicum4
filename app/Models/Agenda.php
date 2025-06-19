<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $fillable = ['medico_id', 'dia', 'hora_inicio', 'hora_fin'];

    public function medico()
    {
        return $this->belongsTo(Medico::class);
    }
}

