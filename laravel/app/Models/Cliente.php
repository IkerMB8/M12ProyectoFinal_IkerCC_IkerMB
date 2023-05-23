<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'clientes';

    public $timestamps = false;

    protected $fillable = [
        'Nombre',
        'Apellido',
        'Telefono',
        'AnioNacimiento',
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
