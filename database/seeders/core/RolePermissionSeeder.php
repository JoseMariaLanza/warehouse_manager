<?php

namespace Database\Seeders\core;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #region Defauld roles
        $guestRole = Role::create(['name' => 'guest', 'guard_name' => 'api']);
        $superAdminRole = Role::create(['name' => 'superadmin', 'guard_name' => 'api']);
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'api']);
        $coordinatorRole = Role::create(['name' => 'coordinator', 'guard_name' => 'api']);
        $sellerRole = Role::create(['name' => 'seller', 'guard_name' => 'api']);
        $travellerRole = Role::create(['name' => 'traveller', 'guard_name' => 'api']);
        $customerRole = Role::create(['name' => 'customer', 'guard_name' => 'api']);
        $dispatcherRole = Role::create(['name' => 'dispatcher', 'guard_name' => 'api']);
        #endregion

        #region Guest permission
        $shiftViewPermission = Permission::create([
            'name' => 'view news',
            'guard_name' => 'api'
        ]);
        #endregion

        #region Shifts permissions
        $shiftViewPermission = Permission::create([
            'name' => 'view shifts',
            'guard_name' => 'api'
        ]);
        $shiftCreatePermission = Permission::create([
            'name' => 'create shifts',
            'guard_name' => 'api'
        ]);
        $shiftUpdatePermission = Permission::create([
            'name' => 'update shifts',
            'guard_name' => 'api'
        ]);
        $shiftDeletePermission = Permission::create([
            'name' => 'delete shifts',
            'guard_name' => 'api'
        ]);
        #endregion

        #region Default users with roles and permissions
        $superadminUser = User::find(1);
        $superadminUser->assignRole($superAdminRole);

        $superAdminRole->givePermissionTo(Permission::all());

        $coordinatorUser = User::find(5);
        $coordinatorUser->assignRole($coordinatorRole);

        $coordinatorRole->givePermissionTo($shiftViewPermission);
        $coordinatorRole->givePermissionTo($shiftCreatePermission);

        // Give permissions to users directly
        $userWithoutRole = User::find(7);
        $userWithoutRole->givePermissionTo($shiftViewPermission);
        $userWithoutRole->givePermissionTo($shiftCreatePermission);
        $userWithoutRole->revokePermissionTo($shiftCreatePermission);

        $superadminUser->givePermissionTo($shiftViewPermission);
        $superadminUser->givePermissionTo($shiftUpdatePermission);
        $superadminUser->revokePermissionTo($shiftViewPermission);

        // dd($coordinatorUser->getAllPermissions());
        #endregion
    }
}
