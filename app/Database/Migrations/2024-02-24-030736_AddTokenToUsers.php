<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTokenToUsers extends Migration
{
    public function up()
    {
        // Check if token column exists
        $fields = $this->db->getFieldNames('users');
        if (!in_array('token', $fields)) {
            $this->forge->addColumn('users', [
                'token' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true,
                    'after' => 'password_hash'
                ]
            ]);
        }
    }

    public function down()
    {
        // Check if token column exists before dropping
        $fields = $this->db->getFieldNames('users');
        if (in_array('token', $fields)) {
            $this->forge->dropColumn('users', 'token');
        }
    }
}
