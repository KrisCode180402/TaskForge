<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\TaskModel;

class Admin extends BaseController
{
    public function __construct()
    {
        // Only allow access if user is logged in and is an Admin (role_id = 1)
        if (!session()->get('isLoggedIn') || session()->get('role_id') != 1) {
            return redirect()->to('login')->send();
        }
    }

    /**
     * Display the Admin Dashboard.
     */
    public function index()
    {
        $data = ['title' => 'Admin Dashboard - TaskForge'];

        // Fetch all users and tasks for administrative overview.
        $userModel = new UserModel();
        $taskModel = new TaskModel();
        $data['users'] = $userModel->findAll();
        $data['tasks'] = $taskModel->findAll();

        return view('templates/header', $data)
            . view('admin/dashboard', $data)
            . view('templates/footer', $data);
    }

    /**
     * Edit a user (e.g., to change their role).
     */
    public function editUser($id)
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        if (!$data['user']) {
            return redirect()->to('admin/dashboard')->with('error', 'User not found.');
        }

        $data['title'] = 'Edit User - TaskForge';
        return view('templates/header', $data)
            . view('admin/edit_user', $data);
    }

    /**
     * Update a user's role.
     */
    public function updateUser($id)
    {
        $userModel = new UserModel();
        $roleId = $this->request->getPost('role_id');
        $data = ['role_id' => $roleId];

        $userModel->update($id, $data);
        return redirect()->to('admin/dashboard')->with('success', 'User updated successfully.');
    }
}
