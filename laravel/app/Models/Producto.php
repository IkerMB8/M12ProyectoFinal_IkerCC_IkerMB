<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use CrudTrait;
    use HasFactory;
    protected $table = 'productos';
    public $timestamps = false;
    protected $fillable = [
        'name', 
        'price', 
        'image', 
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
