<?php

namespace App\Controllers;

class Logout_controller extends BaseController
{
    protected $session;
    public function index()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }
}
