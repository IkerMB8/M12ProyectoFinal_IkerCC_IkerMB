<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linea_Compra extends Model
{
    use HasFactory;

    protected $table = 'LineasCompra';

    protected $primaryKey = ['NumLinea', 'ID_Compra'];

    public $incrementing = false;

    protected $fillable = [
        'NumLinea', 
        'ID_Compra', 
        'Cantidad', 
        'Descuento', 
        'ID_Producto'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_Producto');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'ID_Compra');
    }
}
