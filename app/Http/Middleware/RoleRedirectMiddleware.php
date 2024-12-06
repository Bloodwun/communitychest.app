<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleRedirectMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('index'); // Redirect to login if not authenticated
        }

        $roleId = Auth::user()->role_id;

        // Map roles to their corresponding dashboard routes
        $roleRoutes = [
            \App\Models\Role::ADMIN_ROLE => 'admin.dashboard',
            \App\Models\Role::RESIDENT_ROLE => 'user.dashboard',
            \App\Models\Role::BUSINESS_ROLE => 'business.dashboard',
            \App\Models\Role::PROPERTY_MANAGER_ROLE => 'prop_manager.dashboard',
            \App\Models\Role::STAFF_ROLE => 'staff.dashboard',
            \App\Models\Role::OWNER_ROLE => 'owner.dashboard',
        ];

        if (isset($roleRoutes[$roleId])) {
            return redirect()->route($roleRoutes[$roleId]);
        }

        // If role ID doesn't match, return a 403 or a default view
        abort(403, 'Unauthorized action.');
    }
}
