<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLastLoginToMahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addColumn('mahasiswa', [
            'last_login' => [
                'type' => 'DATETIME',
                'null' => true,
                'after' => 'token'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('mahasiswa', 'last_login');
    }
}
