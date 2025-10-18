<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $fillable = [
        'nit',
        'nombre',
        'correo_electronico',
        'numero_telefono'
    ];
}