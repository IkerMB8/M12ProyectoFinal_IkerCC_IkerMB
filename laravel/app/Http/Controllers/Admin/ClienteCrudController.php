<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClienteRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class ClienteCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClienteCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    protected function authorizeRoles($roles)
    {
        if (Auth::check() && !Auth::user()->hasAnyRole($roles)) {
            abort(403, 'Unauthorized access - you do not have the necessary permissions to see this page.');
        }
    }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        $this->authorizeRoles(['admin', 'trabajador']);
        CRUD::setModel(\App\Models\Cliente::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/cliente');
        CRUD::setEntityNameStrings('cliente', 'clientes');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->authorizeRoles(['admin', 'trabajador']);
        CRUD::column('Nombre');
        CRUD::column('Apellido');
        CRUD::column('Telefono');
        CRUD::column('AnioNacimiento');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->authorizeRoles(['admin', 'trabajador']);
        CRUD::setValidation(ClienteRequest::class);

        CRUD::field('Nombre');
        CRUD::field('Apellido');
        CRUD::field('Telefono');
        CRUD::field('AnioNacimiento');

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->authorizeRoles(['admin', 'trabajador']);
        $this->setupCreateOperation();
    }
}
