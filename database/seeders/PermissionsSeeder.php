<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use function str_replace;

class PermissionsSeeder extends Seeder
{
    private $admin;

    public function __construct()
    {
        $this->admin = User::find(1);
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Config::get("permissions");


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

    private function createPermission($permissions, $role)
    {
        foreach ($permissions as $name => $permission) {
            foreach ($permission as $perm) {
                $permName = $this->handlePermiisionName($perm);

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

    private function handlePermiisionName($perm)
    {
        $perms = ['c' => 'create', 'r' => 'read', 'u' => 'update', 'd' => 'delete', 'v' => 'view'];

        return str_replace($perm, $perms[$perm], $perm);
    }

}
