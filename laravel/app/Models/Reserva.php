<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'Fecha',
        'ID_Cliente',
        'ID_Trabajador',
        'ID_Servicio',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ID_Cliente');
    }

    public function trabajador()
    {
        return $this->belongsTo(Trabajador::class, 'ID_Trabajador');
    }

    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'ID_Servicio');
    }
}
