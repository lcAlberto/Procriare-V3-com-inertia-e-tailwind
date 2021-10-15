<?php

namespace App\Http\Controllers;

use App\Enums\UserRolesEnum;
use App\Support\PermissionsHelper;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index()
    {
        $profiles = config('profile-permissions');

        foreach ($profiles as $profile => $permissions) {
            $rolePermissions = PermissionsHelper::getFlattenPermissions($permissions);
            dd($rolePermissions);
        }
        return Inertia::render('Dashboard');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
