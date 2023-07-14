<?php

namespace App\Http\Middleware;

use App\ApiResponse;
use Closure;
use Core\Account\Domain\AccountService;
use Core\Account\Infrastructure\Facades\JWTAuth;
use Illuminate\Http\Request;

class JWTAuthAcquiredPlanMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $module)
    {
        $client = AccountService::getClient();
        $purchasedPlan = $client->purchased_plan;
        $modulesArray = explode('|', $client->modules);

        $planModules = [
            'Basic'     => ['Shifts'],
            'Mid'       => ['Shifts', 'Warehouse'],
            'Full'      => ['Shifts', 'Warehouse', 'Orders', 'Claims', 'Documents'],
            'Custom'    => $modulesArray
        ];

        if (!boolval($client->is_active)) {
            return ApiResponse::forbidden('Your plan is inactive.');
        }

        foreach ($planModules as $key => $modules) {
            if ($key === $purchasedPlan && in_array($module, $modules, true)) {
                return $next($request);
            }
        }

        return ApiResponse::forbidden('Your plan does not have this feature. Please upgrade your plan to use it.');
    }
}
