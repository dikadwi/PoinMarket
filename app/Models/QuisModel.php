<?php

namespace App\Models;

use CodeIgniter\Model;

class QuisModel extends Model
{
    protected $table = 'quis'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel
    protected $allowedFields = [
        'pertanyaan',
        'opsi_a',
        'opsi_b',
        'opsi_c',
        'opsi_d',
        'jawaban_benar',
        'poin',
        'kategori',
    ];

    // Mendapatkan semua pertanyaan
    public function getAllQuizzes()
    {
        return $this->findAll();
    }

    // Menyimpan jawaban mahasiswa ke tabel jawaban_mahasiswa
    public function insertJawaban($data)
    {
        $builder = $this->db->table('jawaban_mahasiswa');
        return $builder->insert($data);
    }

    // Menghitung poin mahasiswa berdasarkan jawaban yang benar
    public function hitungPoinMahasiswa($idMahasiswa)
    {
        $builder = $this->db->table('jawaban_mahasiswa');
        $builder->select('SUM(quis.poin) as total_poin');
        $builder->join('quis', 'jawaban_mahasiswa.id_pertanyaan = quis.id');
        $builder->where('jawaban_mahasiswa.id_mahasiswa', $idMahasiswa);
        $builder->where('jawaban_mahasiswa.jawaban = quis.jawaban_benar'); // Hanya jawaban yang benar
        $result = $builder->get()->getRow();

        return $result ? $result->total_poin : 0;
    }
}
