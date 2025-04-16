<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTaskStatusesTable extends Migration
{
    public function up()
    {
        // Define the task_statuses table fields.
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'status_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'unique'     => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        // Set primary key and create table using InnoDB engine.
        $this->forge->addKey('id', true);
        $this->forge->createTable('task_statuses', false, ['ENGINE' => 'InnoDB']);

        // Seed default statuses into task_statuses.
        $db = \Config\Database::connect();
        $builder = $db->table('task_statuses');
        $builder->insert(['status_name' => 'To-Do', 'description' => 'Task is pending and not yet started']);
        $builder->insert(['status_name' => 'In-Progress', 'description' => 'Task is currently being worked on']);
        $builder->insert(['status_name' => 'Done', 'description' => 'Task is completed']);
    }

    public function down()
    {
        $this->forge->dropTable('task_statuses');
    }
}
