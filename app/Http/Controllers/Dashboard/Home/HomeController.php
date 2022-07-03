<?php

namespace App\Http\Controllers\Dashboard\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->folder = $this->dPath . ".home.index";
    }

    public function index()
    {
        $data = [
            'title' => "Dashboard",
        ];

        return view($this->folder,$data);
    }
}
