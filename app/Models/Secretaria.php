<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secretaria extends Model
{
    protected $table = 'secretarias';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
}
