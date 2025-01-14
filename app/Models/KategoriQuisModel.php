<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriQuisModel extends Model
{
    protected $table      = 'kategori_quis'; // Nama tabel
    protected $primaryKey = 'id';            // Primary key tabel

    // Kolom yang dapat diisi (fillable)
    protected $allowedFields = [
        'quis_id',  // ID dari tabel quis
        'kategori', // Nama kategori
    ];

    // Jika Anda menggunakan timestamps (created_at, updated_at)
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
