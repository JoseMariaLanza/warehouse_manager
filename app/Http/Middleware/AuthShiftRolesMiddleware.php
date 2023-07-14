<?php

namespace App\Http\Middleware;

use App\ApiResponse;
use Closure;
use Illuminate\Http\Request;

use Core\Account\Infrastructure\Facades\JWTAuth;

class AuthShiftRolesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $module)
    {
        // Obtengo los nombres de los roles en un array proveniente de Front
        $roles = $request->roles;

        $authorizedModuleRoles = [
            'Shifts'    => ['client', 'coordinator', 'dispatcher'],
            'Warehouse' => [], // TODO: Usuarios de smart warehouse
            'Orders'    => [], // TODO: Usuarios de gestión de pedidos
            'Claims'    => [], // TODO: Usuarios de gestión de reclamos
            'Documents' => [], // TODO: Usuarios de gestión documental
        ];

        foreach ($authorizedModuleRoles as $key => $moduleRoles) {

            if ($key === $module) {
                foreach ($moduleRoles as $moduleRole) {
                    if (in_array($moduleRole, $roles)) {
                        return $next($request);
                    }
                }
            }
        }
        return ApiResponse::forbidden('You\'re not authorized to use this module.');
    }
}
