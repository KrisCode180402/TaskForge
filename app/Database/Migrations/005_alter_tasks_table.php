<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTasksTable extends Migration
{
    public function up()
    {
        // Add the status_id column to tasks table
        $fields = [
            'status_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 1,
                'after'      => 'status', // position after the 'status' column
            ],
        ];
        $this->forge->addColumn('tasks', $fields);

        // Add foreign key constraint linking status_id to task_statuses(id)
        $this->db->query('ALTER TABLE tasks ADD CONSTRAINT fk_status FOREIGN KEY (status_id) REFERENCES task_statuses(id)');
    }

    public function down()
    {
        // Remove foreign key constraint first
        $this->db->query('ALTER TABLE tasks DROP FOREIGN KEY fk_status');
        // Then drop the status_id column
        $this->forge->dropColumn('tasks', 'status_id');
    }
}
