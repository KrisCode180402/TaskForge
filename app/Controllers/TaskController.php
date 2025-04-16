<?php

namespace App\Controllers;

use App\Models\TaskModel;
use App\Models\TaskStatusModel;

class TaskController extends BaseController
{
    public function index()
    {
        // Ensure the user is logged in (using your auth filter)
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Please login to access the dashboard.');
        }

        $taskModel = new \App\Models\TaskModel();
        // Use the new method to fetch tasks along with their status names.
        $data['tasks'] = $taskModel->getTasksWithStatus();
        $data['title'] = 'Task Dashboard - TaskForge';

        return view('templates/header', $data)
            . view('tasks/index', $data)
            . view('templates/footer', $data);
    }

    public function create()
    {
        // Only Admin or Manager can create tasks
        if (!$this->isAdminOrManager()) {
            return redirect()->to('tasks')->with('error', 'You are not authorized to create tasks.');
        }

        $data = ['title' => 'Create Task'];
        return view('templates/header', $data)
            . view('tasks/create', $data)
            . view('templates/footer', $data);
    }

    public function store()
    {
        // Only Admin or Manager can create tasks
        if (!$this->isAdminOrManager()) {
            return redirect()->to('tasks')->with('error', 'You are not authorized to create tasks.');
        }

        $taskModel = new TaskModel();
        $taskModel->save([
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'due_date'    => $this->request->getPost('due_date'),
            'status'      => 'To-Do', // default status
            'assigned_to' => null // initially not assigned; adjust as needed
        ]);
        return redirect()->to('tasks')->with('success', 'Task created successfully.');
    }

    public function edit($id)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('id');
        $roleId = session()->get('role_id');

        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task) {
            return redirect()->to('tasks')->with('error', 'Task not found.');
        }

        // If the user is an Employee, allow edit only if they are assigned to the task.
        if ($roleId == 3 && $task['assigned_to'] != $userId) {
            return redirect()->to('tasks')->with('error', 'You are not authorized to edit this task.');
        }

        $data = [
            'title' => 'Edit Task',
            'task'  => $task
        ];
        return view('templates/header', $data)
            . view('tasks/edit', $data)
            . view('templates/footer', $data);
    }

    public function update($id)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to('login');
        }

        $userId = session()->get('id');
        $roleId = session()->get('role_id');

        $taskModel = new TaskModel();
        $task = $taskModel->find($id);

        if (!$task) {
            return redirect()->to('tasks')->with('error', 'Task not found.');
        }

        // Employees can update only tasks assigned to them.
        if ($roleId == 3 && $task['assigned_to'] != $userId) {
            return redirect()->to('tasks')->with('error', 'You are not authorized to update this task.');
        }

        $taskModel->update($id, [
            'title'       => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'due_date'    => $this->request->getPost('due_date'),
            'status'      => $this->request->getPost('status')
        ]);
        return redirect()->to('tasks')->with('success', 'Task updated successfully.');
    }

    public function delete($id)
    {
        // Only Admin can delete tasks
        if (!$this->isAdmin()) {
            return redirect()->to('tasks')->with('error', 'You are not authorized to delete tasks.');
        }

        $taskModel = new TaskModel();
        $taskModel->delete($id);
        return redirect()->to('tasks')->with('success', 'Task deleted successfully.');
    }

    // AJAX endpoint to reorder tasks based on drag-and-drop
    public function reorderTasks()
    {
        // Check for AJAX request
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Invalid request']);
        }

        $taskModel = new TaskModel();
        $order = $this->request->getPost('order');  // Array of task IDs

        if ($order && is_array($order)) {
            // Loop through each task ID and update its position (starting at 1)
            foreach ($order as $position => $taskId) {
                $taskModel->update($taskId, ['position' => $position + 1]);
            }
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No order data provided']);
        }
    }

    /**
     * Helper method to check if the logged-in user is an Admin or Manager.
     * Role IDs: 1 => Admin, 2 => Manager, 3 => Employee.
     */
    private function isAdminOrManager()
    {
        $roleId = session()->get('role_id');
        return ($roleId == 1 || $roleId == 2);
    }

    /**
     * Helper method to check if the logged-in user is an Admin.
     */
    private function isAdmin()
    {
        $roleId = session()->get('role_id');
        return ($roleId == 1);
    }
}
