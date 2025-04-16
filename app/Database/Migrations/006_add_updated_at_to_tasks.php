<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUpdatedAtToTasks extends Migration
{
    public function up()
    {
        // Define the updated_at column. We set it to allow NULL and update automatically.
        $fields = [
            'updated_at' => [
                'type'       => 'TIMESTAMP',
                'null'       => true,
                'default'    => null,
                'on_update'  => 'CURRENT_TIMESTAMP'
            ]
        ];

        // Add the column to the tasks table.
        $this->forge->addColumn('tasks', $fields);
    }

    public function down()
    {
        // Drop the column if rolling back.
        $this->forge->dropColumn('tasks', 'updated_at');
    }
}
