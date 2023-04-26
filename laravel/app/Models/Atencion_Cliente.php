<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atencion_Cliente extends Model
{
    use HasFactory;

    protected $table = 'Atencion_Cliente';

    protected $fillable = [
        'Descripcion',
        'Fecha',
        'ID_Cliente',
        'ID_Trabajador'
    ];

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'ID_Cliente');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Trabajador', 'ID_Trabajador');
    }

    public function mensajes()
    {
        return $this->hasMany('App\Mensaje', 'ID_AtencionCliente');
    }
}