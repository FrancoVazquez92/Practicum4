<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gerencia extends Model
{
    protected $table = 'gerencias';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $fillable = ['id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id');
    }
}
