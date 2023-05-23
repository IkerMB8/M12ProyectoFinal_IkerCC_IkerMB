<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'trabajadores';

    protected $fillable = [
        'Nombre',
        'Apellido',
        'Telefono',
    ];

    protected $primaryKey = 'id';

    public $timestamps = false;

    public function atenciones()
    {
        return $this->hasMany('App\Models\AtencionCliente', 'id_trabajador', 'id');
    }

    public function reservas()
    {
        return $this->hasMany('App\Models\Reserva', 'id_trabajador', 'id');
    }

    public function chats()
    {
        return $this->hasMany('App\Models\Chat', 'id_trabajador', 'id');
    }
}
