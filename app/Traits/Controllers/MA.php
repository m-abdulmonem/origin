<?php

namespace App\Traits\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

trait  MA
{
    protected string $permName = "";

    protected string $path = "frontend";

    protected string $dPath = "dashboard.pages";

    protected string $folder;


    protected function view(string $page, array $ext_data = []): View|Factory|Application
    {
        global $data;

        $d = $ext_data ?? $data;

        return view($this->folder . $page, $d);
    }


    protected function back($msg, $title = null, $updated = false): RedirectResponse
    {
        $status = $updated ? "updated" : "created";

        return back()->with("success", trans("$msg $title was $status successfully"));
    }


}
