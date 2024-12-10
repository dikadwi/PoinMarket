<?php

namespace App\Models;

use CodeIgniter\Model;

class LearningStyleModel extends Model
{
    protected $table = 'gamification_data';
    // protected $primaryKey = 'id'; // Ganti dengan nama kolom primary key yang sesuai
    protected $allowedFields = ['npm', 'nama', 'point', 'challanges', 'leaderboard'];

    // Menggunakan timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at'; // Ganti dengan nama kolom yang sesuai
    protected $updatedField  = 'updated_at'; // Ganti dengan nama kolom yang sesuai

    public function get_students()
    {
        // Mengambil semua data siswa
        return $this->findAll();
    }

    public function get_npm($npm)
    {
        // Mengambil data siswa berdasarkan npm
        return $this->where(['npm' => $npm])->first(); // Menggunakan first() untuk mendapatkan satu hasil
    }

    public function get_gamification_data($studentId)
    {
        // Mengambil data gamifikasi berdasarkan studentId
        return $this->where(['npm' => $studentId])->first(); // Pastikan 'npm' adalah kolom yang digunakan
    }

    public function determine_learning_style($studentData)
    {
        // Logika untuk menentukan gaya belajar berdasarkan data gamifikasi
        // Misalnya, jika point lebih dari 50, gaya belajar adalah 'Visual'
        if ($studentData['point'] > 50) {
            return 'Visual';
        } elseif ($studentData['point'] > 30) {
            return 'Auditory';
        } else {
            return 'Kinesthetic';
        }
    }
}
