<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $workerRole = Role::create(['name' => 'trabajador']);
        $clientRole = Role::create(['name' => 'cliente']);

        Permission::create(['name' => 'clientes.*']);
        Permission::create(['name' => 'clientes.list']);
        Permission::create(['name' => 'clientes.create']);
        Permission::create(['name' => 'clientes.update']);
        Permission::create(['name' => 'clientes.read']);
        Permission::create(['name' => 'clientes.delete']);
        
        Permission::create(['name' => 'productos.*']);
        Permission::create(['name' => 'productos.list']);
        Permission::create(['name' => 'productos.create']);
        Permission::create(['name' => 'productos.update']);
        Permission::create(['name' => 'productos.read']);
        Permission::create(['name' => 'productos.delete']);

        Permission::create(['name' => 'reservas.*']);
        Permission::create(['name' => 'reservas.list']);
        Permission::create(['name' => 'reservas.create']);
        Permission::create(['name' => 'reservas.update']);
        Permission::create(['name' => 'reservas.read']);
        Permission::create(['name' => 'reservas.delete']);

        Permission::create(['name' => 'servicios.*']);
        Permission::create(['name' => 'servicios.list']);
        Permission::create(['name' => 'servicios.create']);
        Permission::create(['name' => 'servicios.update']);
        Permission::create(['name' => 'servicios.read']);
        Permission::create(['name' => 'servicios.delete']);

        Permission::create(['name' => 'users.*']);
        Permission::create(['name' => 'users.list']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.read']);
        Permission::create(['name' => 'users.delete']);
        
        Permission::create(['name' => 'trabajadores.*']);
        Permission::create(['name' => 'trabajadores.list']);
        Permission::create(['name' => 'trabajadores.create']);
        Permission::create(['name' => 'trabajadores.update']);
        Permission::create(['name' => 'trabajadores.read']);
        Permission::create(['name' => 'trabajadores.delete']);


        $adminRole->givePermissionTo([ 'clientes.*', 'productos.*', 'reservas.*', 'servicios.*', 'users.*', 'trabajadores.*' ]);

        $workerRole->givePermissionTo([ 'clientes.*', 'productos.*', 'reservas.*', 'servicios.*', 'trabajadores.list', 'trabajadores.read',  'users.list', 'users.read' ]);

        $clientRole->givePermissionTo([ 'clientes.read', 'reservas.read', 'reservas.list', 'servicios.read', 'servicios.list', 'trabajadores.list', 'trabajadores.read', 'users.read']);

    }
}