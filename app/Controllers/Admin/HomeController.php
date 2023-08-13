<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class HomeController extends BaseController
{
    public function index()
    {
        // Load the view for the home page
        return view('admin/home'); // Assuming you have a 'home.php' view inside the 'app/Views/admin' directory.
    }
}
