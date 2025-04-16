<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table         = 'tasks';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['title', 'description', 'due_date', 'status', 'assigned_to', 'position'];
    protected $useTimestamps = true;

    /**
     * Example method to fetch tasks along with status name (assuming a join with task_statuses table)
     */
    public function getTasksWithStatus()
    {
        // Join the task_statuses table to fetch the human-readable status name.
        return $this->select('tasks.*, task_statuses.status_name')
            ->join('task_statuses', 'task_statuses.id = tasks.status_id', 'left')
            ->orderBy('tasks.due_date', 'ASC')
            ->findAll();
    }
    
}
