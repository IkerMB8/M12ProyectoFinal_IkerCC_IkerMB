<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'Nombre',
        'Apellido',
        'Telefono',
        'Anio_nacimiento',
    ];

    public function atenciones()
    {
        return $this->hasMany(AtencionCliente::class, 'ID_Cliente');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'ID_Cliente');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class, 'ID_Cliente');
    }

    public function compras()
    {
        return $this->hasMany(Compra::class, 'ID_Cliente');
    }
}
