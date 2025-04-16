<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\TaskModel;

class TaskApi extends ResourceController
{
    protected $modelName = 'App\Models\TaskModel';
    protected $format    = 'json';

    // GET /api/tasks
    public function index()
    {
        $tasks = $this->model->findAll();
        return $this->respond($tasks);
    }

    // GET /api/tasks/{id}
    public function show($id = null)
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->failNotFound('Task not found');
        }
        return $this->respond($task);
    }

    // POST /api/tasks
    public function create()
    {
        $data = $this->request->getJSON(true);
        if (!$data) {
            return $this->fail('Invalid input data', 400);
        }
        if (!$this->model->insert($data)) {
            return $this->fail($this->model->errors());
        }
        $data['id'] = $this->model->insertID();
        return $this->respondCreated($data);
    }

    // PUT/PATCH /api/tasks/{id}
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (!$data) {
            return $this->fail('Invalid input data', 400);
        }
        if (!$this->model->update($id, $data)) {
            return $this->fail($this->model->errors());
        }
        return $this->respondUpdated($data);
    }

    // DELETE /api/tasks/{id}
    public function delete($id = null)
    {
        $task = $this->model->find($id);
        if (!$task) {
            return $this->failNotFound('Task not found');
        }
        $this->model->delete($id);
        return $this->respondDeleted(['id' => $id, 'message' => 'Task deleted successfully']);
    }
}
