<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPositionToTasks extends Migration
{
    public function up()
    {
        $fields = [
            'position' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => 0,
                'after'      => 'updated_at', // adjust as needed
            ],
        ];
        $this->forge->addColumn('tasks', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('tasks', 'position');
    }
}
