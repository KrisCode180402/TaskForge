<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\UserModel;

class Manager extends BaseController
{
    public function __construct()
    {
        // Only allow access if user is logged in and is a Manager (role_id = 2)
        if (!session()->get('isLoggedIn') || session()->get('role_id') != 2) {
            return redirect()->to('login')->send();
        }
    }

    /**
     * Display the Manager Dashboard.
     */
    public function index()
    {
        $data = ['title' => 'Manager Dashboard - TaskForge'];

        // Fetch all tasks for oversight.
        $taskModel = new TaskModel();
        $data['tasks'] = $taskModel->findAll();

        return view('templates/header', $data)
            . view('manager/dashboard', $data)
            . view('templates/footer', $data);
    }

    /**
     * Show form to create a new task.
     */
    public function createTask()
    {
        $data = ['title' => 'Create Task - TaskForge'];

        // Optionally, fetch employees to assign tasks.
        $userModel = new UserModel();
        $data['employees'] = $userModel->where('role_id', 3)->findAll();

        return view('templates/header', $data)
            . view('manager/create_task', $data)
            . view('templates/footer', $data);
    }

    /**
     * Save a new task.
     */
    public function storeTask()
    {
        $taskModel = new TaskModel();
        $data = [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'due_date'    => $this->request->getPost('due_date'),
            'status'      => 'To-Do', // default status
            'assigned_to' => $this->request->getPost('assigned_to'),
        ];

        $taskModel->save($data);
        return redirect()->to('manager/dashboard')->with('success', 'Task created successfully.');
    }

    /**
     * AJAX endpoint to reorder tasks based on drag-and-drop.
     */
    public function reorderTasks()
    {
        // Check that this is an AJAX request.
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['status' => 'error', 'message' => 'Invalid request']);
        }

        $order = $this->request->getPost('order');

        // Check if the order data is provided and is an array.
        if ($order && is_array($order)) {
            $taskModel = new \App\Models\TaskModel();
            foreach ($order as $position => $taskId) {
                // Prepare data with the new position.
                $data = ['position' => $position + 1];
                // Attempt to update the task.
                $updated = $taskModel->update($taskId, $data);
                // If the update fails, return an error message.
                if (!$updated) {
                    return $this->response->setJSON([
                        'status' => 'error',
                        'message' => 'Failed to update task ID ' . $taskId
                    ]);
                }
            }
            // If all updates succeed, return success.
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'No order data provided'
            ]);
        }
    }
}
