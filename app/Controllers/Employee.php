<?php

namespace App\Controllers;

use App\Models\TaskModel;

class Employee extends BaseController
{
    public function __construct()
    {
        // Ensure only employees (role_id = 3) can access this controller.
        if (!session()->get('isLoggedIn') || session()->get('role_id') != 3) {
            return redirect()->to('login')->send();
        }
    }

    public function index()
    {
        $data = ['title' => 'Employee Dashboard - TaskForge'];
        // Get the logged-in employee's ID from the session.
        $employeeId = session()->get('id');
        $taskModel = new TaskModel();
        // Retrieve tasks assigned to this employee.
        $data['tasks'] = $taskModel->where('assigned_to', $employeeId)->findAll();

        // Debugging: Uncomment the following lines to check retrieved data.
        // echo '<pre>'; print_r($data['tasks']); exit;

        return view('templates/header', $data)
            . view('employee/dashboard', $data)
            . view('templates/footer', $data);
    }

    public function updateTaskStatus($id)
    {
        $employeeId = session()->get('id');
        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task) {
            return redirect()->to('employee/dashboard')->with('error', 'Task not found.');
        }

        if ($task['assigned_to'] != $employeeId) {
            return redirect()->to('employee/dashboard')->with('error', 'You are not authorized to update this task.');
        }

        $newStatus = $this->request->getPost('status');
        $taskModel->update($id, ['status' => $newStatus]);
        return redirect()->to('employee/dashboard')->with('success', 'Task status updated successfully.');
    }
}
