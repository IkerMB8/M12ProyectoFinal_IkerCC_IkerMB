<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensaje extends Model
{
    use HasFactory;
    protected $table = 'mensajes';

    protected $fillable = [
        'Contenido', 
        'FechaHora', 
        'ID_Chat', 
        'ID_Cliente', 
        'ID_Trabajador'
    ];

    public function chat()
    {
        return $this->belongsTo('App\Chat', 'ID_Chat');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'ID_Cliente');
    }

    public function trabajador()
    {
        return $this->belongsTo('App\Trabajador', 'ID_Trabajador');
    }
}
