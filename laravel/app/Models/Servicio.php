<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;
    
    protected $table = 'servicios';
    public $timestamps = false;
    protected $fillable = [
        'Nombre',
        'Tipo',
        'Precio'
    ];

    public function trabajador()
    {
        return $this->belongsTo('App\Trabajador', 'id_trabajador');
    }

    public function reservas()
    {
        return $this->hasMany('App\Reserva', 'id_servicio');
    }
}
