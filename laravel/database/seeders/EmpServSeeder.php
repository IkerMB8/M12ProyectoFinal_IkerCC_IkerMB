<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use App\Models\Servicio;
use App\Models\Trabajador;
use Illuminate\Support\Facades\Hash;
 
class EmpServSeeder extends Seeder
{
   public function run()
   {
    new Servicio([
        'Nombre'      => "Corte Barba",
        'Tipo'     => "Corte",
        'Precio'  => "5.99",
    ]);
    new Servicio([
        'Nombre'      => "Color mujer",
        'Tipo'     => "Color",
        'Precio'  => "45.99",
    ]);
    new Servicio([
        'Nombre'      => "Corte Hombre",
        'Tipo'     => "Corte",
        'Precio'  => "18.99",
    ]);
    new Trabajador([
        'Nombre'      => "Christian",
        'Apellido'     => "Rios",
        'Telefono'  => "600123123",
    ]);
    new Trabajador([
        'Nombre'      => "Claudio",
        'Apellido'     => "Guirao",
        'Telefono'  => "600123124",
    ]);
    new Trabajador([
        'Nombre'      => "Jana",
        'Apellido'     => "Feixes",
        'Telefono'  => "600123125",
    ]);
    }
}

