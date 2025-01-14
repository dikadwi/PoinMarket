<?php

namespace App\Models;

use CodeIgniter\Model;

class GayaBelajarModel extends Model
{


    protected $table = 'gaya_belajar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['gaya_belajar'];

    public function getGaya()
    {
        return $this->findAll();
    }
}
