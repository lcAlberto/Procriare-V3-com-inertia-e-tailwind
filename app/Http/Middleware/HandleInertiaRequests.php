<?php

namespace App\Http\Middleware;

use App\Enums\UserRolesEnum;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\Models\Permission;

class HandleInertiaRequests extends Middleware
{
    protected $rootView = 'app';

    public function version(Request $request)
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $permissions = $request->user() ? $this->getUserPermissions($request->user()) : '';
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'permissions' => $permissions,
                'role' => $request->user() ? $this->getRoleName($request->user()) : '',
            ],
        ]);
    }

    private function getUserPermissions($user): array
    {
        $roleId = $user->roles()->pluck('id')->first();

        return Permission::query()
            ->whereHas('roles', function ($query) use ($roleId){
                $query->select('role_id');
                $query->where('role_id', $roleId);
            })->pluck('name')->all();
    }

    private function getRoleName($user): string
    {
        if ($user->hasRole(UserRolesEnum::ROOT))
            return UserRolesEnum::ROOT;
        elseif ($user->hasRole(UserRolesEnum::ADMIN))
            return UserRolesEnum::ADMIN;
        elseif ($user->hasRole(UserRolesEnum::CLIENT))
            return UserRolesEnum::CLIENT;
        else
            return abort(403, 'You do not have the right to access any system resources.');
    }
}
