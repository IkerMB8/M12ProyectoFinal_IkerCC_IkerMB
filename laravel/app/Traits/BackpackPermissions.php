<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait BackpackPermissions 
{
    /**
     * @see https://laracasts.com/discuss/channels/laravel/laravel-backpack-permission-on-specific-routes
     */
    protected function _denyAccessIfNoPermission($permission = null, $guard = 'web')
    {
        $user = backpack_user();
        $roles = $user->getRoleNames();
        
        if (!$permission) {
            $table = $this->crud->entity_name_plural;
            $operation = $this->crud->getCurrentOperation();
            $permission = strtolower("{$table}.{$operation}");    
        }
        
        $msg = "'{$user->name}' with roles $roles has permission '{$permission}'";

        if (!$user->hasPermissionTo($permission, $guard)) {
            $this->crud->denyAccess($this->crud->getCurrentOperation());
            Log::debug("{$msg}: NO");
        } else {
            Log::debug("{$msg}: YES");
        }
    }
}