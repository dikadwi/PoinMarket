<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{


    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'npm', 'nama', 'email', 'password', 'point', 'gaya_belajar', 'created_at', 'updated_at', 'deleted_at', 'token', 'last_login'];

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

    // Metode untuk mengambil data mahasiswa berdasarkan NPM
    public function findByNpm($npm)
    {
        // Menggunakan where untuk mencari mahasiswa berdasarkan NPM
        return $this->where('npm', $npm)->first();
    }

    // Metode untuk mengambil poin berdasarkan NPM
    public function getPointByNpm($npm)
    {
        return $this->where('npm', $npm)->select('point')->first();
    }

    // Fungsi untuk mengambil poin mahasiswa berdasarkan NPM
    public function getPoinByNPM($npm)
    {
        return $this->where('npm', $npm)->first();
    }

    // Fungsi untuk mengambil data mahasiswa berdasarkan NPM
    public function getNamaByNpm($npm)
    {
        return $this->where('npm', $npm)->first(); // Mengambil data mahasiswa berdasarkan NPM
    }

    public function updateToken($npm, $token)
    {
        try {
            $result = $this->db->table($this->table)
                ->where('npm', $npm)
                ->update(['token' => $token]);
            
            if ($result) {
                // Verifikasi update berhasil
                $updated = $this->where('npm', $npm)->first();
                return $updated && $updated['token'] === $token;
            }
            return false;
        } catch (\Exception $e) {
            log_message('error', 'Error updating token: ' . $e->getMessage());
            return false;
        }
    }
}
