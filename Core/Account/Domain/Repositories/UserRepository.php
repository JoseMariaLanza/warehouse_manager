<?php

namespace Core\Account\Domain\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\ApiResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserRepository
{
    public static function create(Request $request)
    {
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            if ($user->exists) {
                $user->assignRole(Role::findByName('guest', 'api'));
            }

            return $user;
        } catch (\Exception $ex) {
            return ApiResponse::serverError('User already exists.');
        }
    }

    public static function loginERP() // TODO: return User Type
    {
        // TODO: Call ERP Adapter to convert to a User Type
        return DB::connection('customers')->table('users')
            ->where('email', env('CUSTOMER_EMAIL', null))
            ->orWhere('alternative_email', env('CUSTOMER_EMAIL', null))
            ->first();
        // return ERP user data
    }

    public static function login($email)
    {
        try {
            $erpClient = self::loginERP();
            if (empty($erpClient)) {
                // TODO: Create a Exception handler for bellow cases:
                // 1. ERP Service down (500)
                // 2. Unregistered Client Exception - ERP empty user response (above)
                // throw new NotFoundHttpException('Client unregistered in ERP.');
                return ApiResponse::notFound('Client unregistered in ERP.');
            }

            $user = User::where('email', $email)->with(['roles' => function ($query) {
                $query->select('name');
            }])->first();

            if ($user) {
                $permissions = $user->getAllPermissions();
                $user->permissions = $permissions;
            }
            return $user;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function getRawRoles()
    {
        //
    }
}
