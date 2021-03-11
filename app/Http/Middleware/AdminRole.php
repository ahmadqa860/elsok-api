<?php

namespace App\Http\Middleware;

use Closure;

class ShopOwnerRole
{
    public function handle($request, Closure $next)
    {

        $permissions = auth()->user()->hasPermissions->toArray();
    
        foreach ($permissions as $permission) {
            if ($permission['permission_id'] == 1) {
                return $next($request);
            }
        }

        return response("not Allowed");
    }
}