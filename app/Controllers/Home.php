<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // If user is logged in, redirect based on role
        if (session()->get('isLoggedIn')) {
            $role_id = session()->get('role_id');
            switch ($role_id) {
                case 1:
                    return redirect()->to('admin/dashboard');
                case 2:
                    return redirect()->to('manager/dashboard');
                default:
                    return redirect()->to('employee/dashboard');
            }
        }

        // For guests, display the public home page
        $data = [
            'title'   => 'Home - TaskForge',
            'navType' => 'home'
        ];
        return view('home', $data);
    }
}
