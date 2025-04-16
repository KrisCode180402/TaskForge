<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTasksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title'       => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'due_date'    => [
                'type' => 'DATE',
                'null' => true,
            ],
            // New foreign key column for status
            'status_id'   => [
                'type'     => 'INT',
                'unsigned' => true,
                'default'  => 1, // Assuming default "To-Do" has id 1 in task_statuses
            ],
            'assigned_to' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => true,
            ],
            'created_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at'  => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        // Set foreign key constraint for status_id
        $this->forge->addForeignKey('status_id', 'task_statuses', 'id', 'CASCADE', 'CASCADE');

        // Optionally add foreign key for assigned_to if needed.
        // $this->forge->addForeignKey('assigned_to', 'users', 'id', 'SET NULL', 'CASCADE');

        $this->forge->createTable('tasks', false, ['ENGINE' => 'InnoDB']);
    }

    public function down()
    {
        $this->forge->dropTable('tasks');
    }
}
