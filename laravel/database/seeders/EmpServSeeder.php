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
    $servicio1 = new Servicio([
        'Nombre'      => "Corte Barba",
        'Tipo'     => "Corte",
        'Precio'  => "5.99",
    ]);
    $servicio1->save();
    $servicio2 = new Servicio([
        'Nombre'      => "Color mujer",
        'Tipo'     => "Color",
        'Precio'  => "45.99",
    ]);
    $servicio2->save();
    $servicio3 = new Servicio([
        'Nombre'      => "Corte Hombre",
        'Tipo'     => "Corte",
        'Precio'  => "18.99",
    ]);
    $servicio3->save();
    $christian = new Trabajador([
        'Nombre'      => "Christian",
        'Apellido'     => "Rios",
        'Telefono'  => "600123123",
    ]);
    $christian->save();
    $claudio = new Trabajador([
        'Nombre'      => "Claudio",
        'Apellido'     => "Guirao",
        'Telefono'  => "600123124",
    ]);
    $claudio->save();
    $jana =  new Trabajador([
        'Nombre'      => "Jana",
        'Apellido'     => "Feixes",
        'Telefono'  => "600123125",
    ]);
    $jana->save();
    }
}

