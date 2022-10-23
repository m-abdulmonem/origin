<?php

namespace App\Http\Controllers\Dashboard\Utils;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Config;


class PermissionsController extends Controller
{
    private User $admin;

    public function __construct()
    {
        $this->admin = User::find(1);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = Config::get("permissions");

        $this->truncateTables();

        foreach ($data as $role => $permissions) {
            $ucRole = ucfirst(str_replace("_", " ", $role));

            $createRole = Role::create([
                'name' => $role,
                'display_name' => $ucRole,
                'description' => "allow $role"
            ]);

            $this->admin->attachRole($createRole);

            $this->createPermission($permissions, $createRole);
        }
    }

    private function truncateTables()
    {
        Permission::query()->delete();
        Role::query()->delete();
    }

    private function createPermission($permissions, $role)
    {
        foreach ($permissions as $name => $permission) {
            foreach ($permission as $perm) {
                $permName = $this->handlePermissionName($perm);

                $createdPerm = Permission::create([
                    'name' => "$permName-$name",
                    'display_name' => ucfirst($permName) . " " . ucfirst($name),
                    'description' => ""
                ]);

                $role->attachPermission($createdPerm);
                $this->admin->attachPermission($createdPerm);
            }
        }
    }

    private function handlePermissionName($perm): array|string
    {
        $perms = ['c' => 'create', 'r' => 'read', 'u' => 'update', 'd' => 'delete', 'v' => 'view'];

        return str_replace($perm, $perms[$perm], $perm);
    }
}
