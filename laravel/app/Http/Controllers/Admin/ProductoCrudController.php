<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductoRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProductoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductoCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Producto::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/producto');
        CRUD::setEntityNameStrings('producto', 'productos');
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
        CRUD::column('name');
        CRUD::column('price');
        CRUD::column('image');

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
        CRUD::setValidation(ProductoRequest::class);

        CRUD::field('name');
        CRUD::field('price');
        CRUD::field('image');

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
