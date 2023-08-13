<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\User;
class UserController extends BaseController
{
    // Show the login form
    public function login()
    {
        return view('admin/login');
    }

    // Process the login form submission
    public function doLogin()
    {
        $userModel = new User();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Retrieve the user from the database by username
        $user = $userModel->where('username', $username)->first();

        // Check if the user exists and verify the password
        if ($user && password_verify($password, $user['password'])) {
            // Store user data in session
            $session = session();
            $userData = [
                'id' => $user['id'],
                'username' => $user['username'],
                // Add other user data you want to store in session
            ];
            $session->set($userData);

            // Redirect to the home page or dashboard
            return redirect()->to('admin/home'); // Replace 'admin/home' with the actual URL of your home page or dashboard
        } else {
            // Login failed, redirect back to login page with error message
            return redirect()->back()->with('error', 'Invalid username or password');
        }
    }

    // Logout the user
    public function logout()
    {
        // Destroy the session and log the user out
        $session = session();
        $session->destroy();

        // Redirect to the login page
        return redirect()->to('admin/login'); // Replace 'admin/login' with the actual URL of your login page
    }

    // Show the registration form
    public function register()
    {
        return view('admin/register');
    }

    // Process the registration form submission
    public function doRegister()
    {
        $userModel = new User();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'email'    => $this->request->getPost('email'),
        ];

        $userModel->insert($data);

        // Registration successful, redirect to the login page with success message
        return redirect()->to('admin/login')->with('success', 'Registration successful. Please log in.');
    }
}
