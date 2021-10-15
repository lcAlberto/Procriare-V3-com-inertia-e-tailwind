<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SyncPermissionRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissionsByRole = config('profile-permissions');
//        dd($permissionsByRole);

        $insertPermissions = function ($role) use ($permissionsByRole) {
            return collect($permissionsByRole[$role])
                ->map(function ($name) {
                    return DB::table('permissions')->insertGetId(['name' => $name, 'guard_name' => 'web']);
                })
                ->toArray();
        };

        $permissionIdsByRole = [
            'root' => $insertPermissions(UserRolesEnum::ROOT),
            'admin' => $insertPermissions(UserRolesEnum::ADMIN),
            'client' => $insertPermissions(UserRolesEnum::CLIENT)
        ];

        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::findByName($role)->first();
            dd($role);

            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(function ($id) use ($role) {
                        return [
                            'role_id' => $role->id,
                            'permission_id' => $id
                        ];
                    })->toArray()
                );
        }
    }
}
