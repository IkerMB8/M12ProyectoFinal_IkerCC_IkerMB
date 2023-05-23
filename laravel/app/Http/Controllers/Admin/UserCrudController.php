<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
        
        $this->authorizeRoles(['admin']);
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->authorizeRoles(['admin']);

        CRUD::column('name');
        CRUD::column('email');
        CRUD::column('password');
        CRUD::column('ID_Cliente');
        
        // Agregar el campo de roles
        CRUD::addColumn([
            'name' => 'roles',
            'label' => 'Roles',
            'type' => 'closure',
            'function' => function ($entry) {
                return implode(', ', $entry->getRoleNames()->toArray());
            }
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        $this->authorizeRoles(['admin']);
        
        CRUD::setValidation(UserRequest::class);

        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('password');
        CRUD::field('ID_Cliente');
        
        // Campo de selección de roles
        CRUD::addField([
            'name' => 'roles',
            'label' => 'Roles',
            'type' => 'select_multiple',
            'entity' => 'roles',
            'attribute' => 'name',
            'model' => \Spatie\Permission\Models\Role::class,
            'pivot' => true,
        ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->authorizeRoles(['admin']);
        
        $this->setupCreateOperation();

        CRUD::removeField('password');
    }
}
