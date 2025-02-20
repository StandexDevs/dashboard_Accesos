<?php

namespace App\Controllers;
use IonAuth\Libraries\IonAuth;

class Dashboard extends BaseController{
    protected $ionAuth;

    public function __construct()
    {
        $this->ionAuth = new IonAuth();
    }

    public function index()
    {
        if(!$this->ionAuth->loggedIn()){
            return redirect()->to('/auth/')->withCookies();
        }

        return view('dashboard/index');
    }
}