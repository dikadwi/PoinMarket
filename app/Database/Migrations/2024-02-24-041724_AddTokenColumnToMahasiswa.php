<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTokenColumnToMahasiswa extends Migration
{
    public function up()
    {
        // Hapus kolom token yang mungkin sudah ada
        if ($this->db->fieldExists('token', 'mahasiswa')) {
            $this->forge->dropColumn('mahasiswa', 'token');
        }

        // Tambah kolom token baru
        $this->forge->addColumn('mahasiswa', [
            'token' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'password'
            ]
        ]);

        // Tambah index untuk pencarian token
        $this->forge->addKey('token');
    }

    public function down()
    {
        if ($this->db->fieldExists('token', 'mahasiswa')) {
            $this->forge->dropColumn('mahasiswa', 'token');
        }
    }
}
