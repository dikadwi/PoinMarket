<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{


    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'nama', 'npm', 'password', 'point', 'created_at', 'updated_at', 'deleted_at'];

    // //Dates
    protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    public function total()
    {
        return $this->countAll();
    }

    public function getMhs()
    {
        return $this->findAll();
    }

    public function getPoinByNPM($npm)
    {
        return $this->where('npm', $npm)->first();
    }
}
