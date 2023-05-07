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

        Permission::create(['name' => 'trabajadores.*']);
        Permission::create(['name' => 'trabajadores.list']);
        Permission::create(['name' => 'trabajadores.create']);
        Permission::create(['name' => 'trabajadores.update']);
        Permission::create(['name' => 'trabajadores.read']);
        Permission::create(['name' => 'trabajadores.delete']);

        Permission::create(['name' => 'clientes.*']);
        Permission::create(['name' => 'clientes.list']);
        Permission::create(['name' => 'clientes.create']);
        Permission::create(['name' => 'clientes.update']);
        Permission::create(['name' => 'clientes.read']);
        Permission::create(['name' => 'clientes.delete']);

        Permission::create(['name' => 'servicios.*']);
        Permission::create(['name' => 'servicios.list']);
        Permission::create(['name' => 'servicios.create']);
        Permission::create(['name' => 'servicios.update']);
        Permission::create(['name' => 'servicios.read']);
        Permission::create(['name' => 'servicios.delete']);

        Permission::create(['name' => 'compras.*']);
        Permission::create(['name' => 'compras.list']);
        Permission::create(['name' => 'compras.create']);
        Permission::create(['name' => 'compras.update']);
        Permission::create(['name' => 'compras.read']);
        Permission::create(['name' => 'compras.delete']);

        Permission::create(['name' => 'chats.*']);
        Permission::create(['name' => 'chats.list']);
        Permission::create(['name' => 'chats.create']);
        Permission::create(['name' => 'chats.update']);
        Permission::create(['name' => 'chats.read']);
        Permission::create(['name' => 'chats.delete']);

        Permission::create(['name' => 'mensajes.*']);
        Permission::create(['name' => 'mensajes.list']);
        Permission::create(['name' => 'mensajes.create']);
        Permission::create(['name' => 'mensajes.update']);
        Permission::create(['name' => 'mensajes.read']);
        Permission::create(['name' => 'mensajes.delete']);

        Permission::create(['name' => 'users.*']);
        Permission::create(['name' => 'users.list']);
        Permission::create(['name' => 'users.create']);
        Permission::create(['name' => 'users.update']);
        Permission::create(['name' => 'users.read']);
        Permission::create(['name' => 'users.delete']);


        $adminRole->givePermissionTo([ 'trabajadores.*', 'clientes.*', 'servicios.*','users.*', 'mensajes.*', 'chats.*', 'compras.*' ]);

        $workerRole->givePermissionTo([ 'trabajadores.list', 'trabajadores.read', 'clientes.list', 'clientes.read', 'servicios.list', 'servicios.read' ]);

        $clientRole->givePermissionTo([ 'clientes.*', 'servicios.*' ]);


        // $name = config('admin.name');
        // $admin = User::where('name', $name)->first();
        // $admin->assignRole('admin');
    }
}