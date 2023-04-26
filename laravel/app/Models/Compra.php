<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $table = 'compras';
    protected $fillable = [
        'Fecha',
        'ID_Cliente',
        'Precio_Total'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'ID_Cliente');
    }

    public function lineasCompra()
    {
        return $this->hasMany('App\LineasCompra', 'ID_Compra');
    }
}
