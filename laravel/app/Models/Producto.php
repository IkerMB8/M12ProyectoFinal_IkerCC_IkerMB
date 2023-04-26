<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table = 'productos';
    protected $fillable = [
        'Nombre', 
        'Descripcion', 
        'Cantidad', 
        'Precio'
    ];

    public function lineasCompra()
    {
        return $this->hasMany(LineaCompra::class, 'ID_Producto');
    }

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'producto_servicio', 'ID_Producto', 'ID_Servicio');
    }
}