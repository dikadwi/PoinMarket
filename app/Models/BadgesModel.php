<?php

namespace App\Models;

use CodeIgniter\Model;

class BadgesModel extends Model
{


    protected $table = 'badges';
    protected $primaryKey = 'id_badges';
    protected $allowedFields = ['nama', 'point', 'detail', 'keterangan', 'badges'];

    // //Dates
    // protected $useTimestamps = true;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    public function getBadges()
    {
        return $this->findAll();
    }

    public function saveBadge($data)
    {
        return $this->insert($data);
    }

    public function totalBadges()
    {
        return $this->countAll();
    }
}
