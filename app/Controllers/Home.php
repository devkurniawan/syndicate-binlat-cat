<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return redirect()->to('cat');
        return view('template/apps/home', [
            "page"  => "home/dashboard2",
            "menu"  => "home"
        ]);
    }
}
