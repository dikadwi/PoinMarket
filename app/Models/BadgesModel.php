<?php

namespace App\Models;

use CodeIgniter\Model;

class BadgesModel extends Model
{


    protected $table = 'badges';
    protected $primaryKey = 'id_badges';
    protected $allowedFields = ['nama', 'point', 'detail', 'keterangan', 'badges', 'updated_at'];

    // //Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // Menampilkan semua badges
    public function getBadges()
    {
        return $this->findAll();
    }

    // public function saveBadge($data)
    // {
    //     return $this->insert($data);
    // }

    // // Membuat badges baru
    // public function createBadge($data)
    // {
    //     return $this->insert($data);
    // }

    // // Menampilkan detail badges
    // public function findBadge($id_badges)
    // {
    //     return $this->find($id_badges);
    // }

    // // Mengupdate badges
    // public function updateBadge($id_badges, $data)
    // {
    //     return $this->update($id_badges, $data);
    // }

    // // Menghapus badges
    // public function deleteBadge($id_badges)
    // {
    //     return $this->delete($id_badges);
    // }

    // Menghitung total badges
    public function totalBadges()
    {
        return $this->countAll();
    }
}
