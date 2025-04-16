<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskStatusModel extends Model
{
    protected $table = 'task_statuses';
    protected $primaryKey = 'id';
    protected $allowedFields = ['status_name', 'description'];
}
