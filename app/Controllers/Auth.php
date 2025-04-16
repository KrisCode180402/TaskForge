<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RoleModel;

class Auth extends BaseController
{
    /**
     * Display the login form.
     */
    public function login()
    {
        helper(['form']);
        $data = ['title' => 'Login - TaskForge'];
        return view('templates/header', $data)
            . view('auth/login', $data);
    }

    /**
     * Process login credentials.
     */
    public function attemptLogin()
    {
        helper(['form']);
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Set session data
            session()->set([
                'id'         => $user['id'],  // Employee's unique ID
                'username'   => $user['username'],
                'role_id'    => $user['role_id'],  // Should be 3 for employees
                'isLoggedIn' => true,
            ]);

            // Redirect users based on role
            switch ($user['role_id']) {
                case 1:
                    return redirect()->to('admin/dashboard');
                case 2:
                    return redirect()->to('manager/dashboard');
                default:
                    return redirect()->to('employee/dashboard');
            }
        } else {
            session()->setFlashdata('error', 'Invalid login credentials.');
            return redirect()->to('login')->withInput();
        }
    }

    /**
     * Display the registration form.
     * Fetch available roles from the database and pass to the view.
     */
    public function register()
    {
        helper(['form']);
        $roleModel = new RoleModel();
        $data = [
            'title' => 'Register - TaskForge',
            'roles' => $roleModel->findAll() // Fetch all roles for selection
        ];
        return view('templates/header', $data)
            . view('auth/register', $data)
            . view('templates/footer', $data);
    }

    /**
     * Process registration data.
     */
    public function attemptRegister()
    {
        helper(['form']);

        // Set validation rules
        $rules = [
            'username'     => 'required|min_length[3]|max_length[50]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[8]',
            'pass_confirm' => 'matches[password]',
            'role_id'      => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        // Get the role id directly from the form
        $roleId = $this->request->getPost('role_id');

        // Optionally, verify that the role exists
        $roleModel = new RoleModel();
        $role = $roleModel->find($roleId);
        if (!$role) {
            return redirect()->back()->withInput()->with('error', 'Selected role is invalid.');
        }

        // Prepare user data; ensure that your UserModel hashes the password automatically.
        $userData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'role_id'  => $roleId,
        ];

        $userModel = new UserModel();
        if (!$userModel->save($userData)) {
            return redirect()->back()->withInput()->with('error', implode(', ', $userModel->errors()));
        }

        return redirect()->to('login')->with('success', 'Registration successful! Please login.');
    }

    /**
     * Log the user out.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('login');
    }
}
