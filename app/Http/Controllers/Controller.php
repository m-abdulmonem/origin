<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use function view;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected string $permName = "";
    protected string $path = "frontend";
    protected string $dPath = "dashboard.pages";

    protected string $folder;


    protected function can(string $permission)
    {
        $perms = ['c' => 'create', 'r' => 'read', 'u' => 'update', 'd' => 'delete', 'v' => 'view'];

        $replace = array_key_exists($permission, $perms) ? $perms[$permission] : $permission;

        $perm = str_replace($permission, $replace, $permission);

        if (!Auth::user()->hasPermission("$perm-" . $this->permName)) {
            abort(403);
        }
    }

    protected function view(string $page, array $ext_data = [])
    {
        global $data;

        $d = $ext_data ?? $data;

        return view($this->folder . $page, $d);
    }


    protected function back($msg, $title = null, $updated = false)
    {
        $status = $updated ? "updated" : "created";

        return back()->with("success", trans("$msg $title was $status successfully"));
    }

}
