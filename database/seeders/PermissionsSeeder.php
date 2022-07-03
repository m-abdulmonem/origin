<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Permission;
use App\Models\User;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = User::find(1);
        $perArr =  ['c','r','u','d','v'];
        $data = [
            'superAdmin' => [
                'product' => $perArr,
                'pages' => $perArr,
                'services' => $perArr
            ],
        ];


        foreach ($data as $role => $permissions) {
            $ucRole = ucfirst(\str_replace("_"," ", $role));

            $createRole = Role::create([
                'name' => $role,
                'display_name' => $ucRole,
                'description' => "allow $role"
            ]);
            $admin->attachRole($createRole);
            foreach ($permissions as $name => $permission) {
                foreach ($permission as $perm) {
                    $permName =  $this->handlePermiisionName($perm);

                    $createdPerm = Permission::create([
                        'name' => "$permName-$name",
                        'display_name' => ucfirst($permName) . " " . ucfirst($name),
                        'description' => ""
                    ]);

                    $createRole->attachPermission($createdPerm);
                    $admin->attachPermission($createdPerm);
                }
            }
        }
    }

    private function handlePermiisionName($perm)
    {
        $perms = ['c'=>'create','r'=>'read','u'=>'update','d'=>'delete','v'=>'view'];

        return \str_replace($perm,$perms[$perm],$perm);
    }

}
