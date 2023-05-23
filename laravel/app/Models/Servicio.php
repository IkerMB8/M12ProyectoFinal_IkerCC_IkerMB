<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use CrudTrait;
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
        return $this->belongsTo(Trabajador::class, 'id_trabajador');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_servicio');
    }
}
