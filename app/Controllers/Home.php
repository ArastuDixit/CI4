<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');        
        // return 'This is our Home Page';
        // return view('home');
    }
}
