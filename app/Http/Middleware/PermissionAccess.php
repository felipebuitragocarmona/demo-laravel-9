<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\PermissionRole;

class PermissionAccess
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

        if (!auth('api')->user()) {
            return response()->json(['You do not have permission to access for this page.'], 401);
        } else {
            error_log('----------permisos ---------------');
            $user = auth('api')->user();
            error_log('id rol>' . $user->role_id);
            //error_log('id usuario>' . $request);
            $method =  $request->method();
            error_log('metodo>' . $method);
            $url =  $request->path();
            //error_log('url>' . $url);
            $newURL = $this->processURL($url);
            error_log('new url>' . $newURL);

            $permission = Permission::where([
                ['url', $newURL],
                ['method', $method]
            ])->first();
            if ($permission) {
                error_log('permiso ' . $permission->id);
                $permission_role = PermissionRole::where([
                    ['role_id', $user->role_id],
                    ['permission_id', $permission->id]
                ])->first();
                if($permission_role){
                    return $next($request);
                }else{
                    return response()->json(['You do not have permission to access for this page.'], 401);
                }
                error_log('permiso rol ' . $permission_role);
            }else{
                return response()->json(['You do not have permission to access for this page.'], 401);
            }

            
        }
    }
    public function processURL($originalURL)
    {
        $parts = explode("/", $originalURL);
        $newURL = "";
        for ($i = 1; $i < count($parts); $i++) {
            $pattern = '/[0-9]/';
            if (preg_match_all($pattern, $parts[$i]) >= 1) {
                $newURL = $newURL . "?" . "/";
            } else {
                $newURL = $newURL . $parts[$i] . "/";
            }
        }
        $newURL = substr($newURL, 0, strlen($newURL) - 1);
        return $newURL;
    }
}
