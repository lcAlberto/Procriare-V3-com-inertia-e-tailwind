<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRoot();
        $this->createAdmin();
        $this->createClient();
    }

    private function createRoot()
    {
        $root = User::firstOrNew([
            'email' => 'root@procriare.com'
        ]);
        $permissions = Permission::pluck('guard_name', 'id')->all();

//        $permissions = $permissions->pluck('guard_name');

        $root->fill([
            'name' => 'Root',
            'email' => 'root@procriare.com',
            'password' => Hash::make('rootprocriare123'),
            'email_verified_at' => now()->toDateString(),
            'is_owner' => false,
            'img_profile' => 'default.jpg',
            'farm_id' => 1,
        ]);

        $root->save();

        if (!$root->hasRole(\App\Enums\UserRolesEnum::ROOT)) {
            $root->assignRole(\App\Enums\UserRolesEnum::ROOT);
        }
    }

    private function createAdmin()
    {
        $admin = User::firstOrNew([
            'email' => 'admin@procriare.com'
        ]);

        $admin->fill([
            'name' => 'Admin',
            'email' => 'admin@procriare.com',
            'password' => Hash::make('adminprocriare123'),
            'email_verified_at' => now()->toDateString(),
            'is_owner' => true,
            'img_profile' => 'default.jpg',
            'farm_id' => 1,
        ]);

        $admin->save();

        if (!$admin->hasRole(\App\Enums\UserRolesEnum::ADMIN)) {
            $admin->assignRole(\App\Enums\UserRolesEnum::ADMIN);
        }
    }

    private function createClient()
    {
        $client = User::firstOrNew([
            'email' => 'client@procriare.com'
        ]);

        $client->fill([
            'name' => 'Client',
            'email' => 'client@procriare.com',
            'password' => Hash::make('clientprocriare123'),
            'email_verified_at' => now()->toDateString(),
            'is_owner' => true,
            'img_profile' => 'default.jpg',
            'farm_id' => 1,
        ]);

        $client->save();

        if (!$client->hasRole(\App\Enums\UserRolesEnum::CLIENT)) {
            $client->assignRole(\App\Enums\UserRolesEnum::CLIENT);
        }
    }
}
