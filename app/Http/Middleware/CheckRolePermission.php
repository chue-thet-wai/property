<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Permissions;

class CheckRolePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $route = Route::getRoutes()->match($request);
        return $next($request);

        $controllerPath = $route->getActionName();
        $controllerAction = ltrim(strrchr($controllerPath, "\\"), "\\");

        $permission = Permissions::where('controller_method',$controllerAction)->first();
       
        if (Auth::user() &&  !empty($permission)) {
            $permission_id = $permission->id;
            //$role_id = Auth::user()->role;
            $role_id = 1;

            $chkRolePermission = DB::table('roles_permissions')
                                ->where('role_id',$role_id)
                                ->where('permission_id',$permission_id)
                                ->whereNull('deleted_at')
                                ->first();
            
            if (!empty($chkRolePermission)) {
                return $next($request);
            }
        }

       return redirect('/home')->with('error','You have not admin access');
    }
}
