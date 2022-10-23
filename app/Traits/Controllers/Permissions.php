<?php

namespace App\Traits\Controllers;

use Illuminate\Support\Facades\Auth;

trait  Permissions
{

    private array $perms = ['c' => 'create', 'r' => 'read', 'u' => 'update', 'd' => 'delete', 'v' => 'view'];


    protected function can(string $permission): void
    {

        $perm = "";

        if (array_key_exists($permission, $this->perms)) {
            $perm = str_replace($permission, $this->perms[$permission], $permission) . "-" . $this->permName;
        }

        if (!Auth::user()->hasPermission($perm)) {
            abort(403);
        }
    }

    protected function any(array $permission): void
    {
        $permissions = [];

        foreach ($permission as $item) {
            $permissions[] = str_replace($item, $this->perms[$item], $item) . "-" . $this->permName;
        }


        if (!Auth::user()->hasPermission($permissions)) {
            abort(403);
        }
    }


}
