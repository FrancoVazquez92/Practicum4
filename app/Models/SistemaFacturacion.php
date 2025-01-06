<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SistemaFacturacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'Numero de factura',
        'Datos razon social',
        'Datos del Cliente',
        'Detalle',
        'Impuestos',
        'Monto'
    ];
}
