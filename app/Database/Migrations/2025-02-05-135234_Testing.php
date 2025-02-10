<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Testing extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tes' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_tes', true);
        $this->forge->createTable('testing');
    }

    public function down()
    {
        $this->forge->dropTable('testing');
    }
}
