<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'Referencia',
        'Gramos',
        'Tamano',
        'Color',
        'PrecioUnitario',
        'CantidadStock',
        'Estado'
    ];
}