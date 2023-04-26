<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    
    protected $table = 'Chat';

    protected $fillable = [
        'Fecha_creacion',
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
        return $this->hasMany('App\Mensaje', 'ID_Chat');
    }
}
