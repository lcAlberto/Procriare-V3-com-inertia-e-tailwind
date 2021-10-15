<?php

namespace Database\Seeders;

use App\Models\User;
use App\Support\PermissionsHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

//use Spatie\Permission\Contracts\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private function getPermissions()
    {
        return config('permissions');
    }

    public function run()
    {
        $permissions = $this->getPermissions();
        $permissions = PermissionsHelper::getFlattenPermissions($permissions);
        foreach ($permissions as $permission) {
            $model = Permission::findOrCreate($permission, 'web');
            $model->save();
        }
    }
}
