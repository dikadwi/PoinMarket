<?php

namespace App\Models;

use CodeIgniter\Model;

class DataTransaksiModel extends Model
{


    protected $table = 'data_transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['kode_jenis', 'nama_transaksi', 'npm', 'poin_digunakan', 'poin_diberikan', 'validation', 'claim', 'tanggal_transaksi'];
    protected $createdField  = 'tanggal_transaksi';

    // Mengambil Semua Data
    public function getDataTransaksi()
    {
        return $this->findAll();
    }

    public function getDataTransaksiUser($npm)
    {
        // Adjust your query to filter transactions based on the npm parameter
        return $this->where('npm', $npm)->get()->getResultArray();
    }

    public function getDataValidasi()
    {
        return $this->where('validation', 'Belum')->findAll();
    }

    // Mengambil NPM untuk ditampilkan
    public function getNpmList()
    {
        $npmList = $this->distinct()->select('npm')->findAll();

        return array_column($npmList, 'npm');
    }

    // Menampilkan data berdasarkan kode_jenis
    // Menampilkan total jenis 101
    public function totalReward()
    {
        return $this->where('kode_jenis', 101)->countAllResults();
    }
    // Menampilkan total jenis 102
    public function totalPembelian()
    {
        return $this->where('kode_jenis', 102)->countAllResults();
    }
    // Menampilkan total jenis 103
    public function totalPunishment()
    {
        return $this->where('kode_jenis', 103)->countAllResults();
    }
    // Menampilkan total jenis 105
    public function totalMisi()
    {
        return $this->where('kode_jenis', 105)->countAllResults();
    }
    // Menampilkan total jenis 106
    public function totalKonsultasi()
    {
        return $this->where('kode_jenis', 106)->countAllResults();
    }
    public function totalTransaksi()
    {
        return $this->where('validation', 'Sudah')->countAllResults();
    }
    public function totalValidasi()
    {
        return $this->where('validation', 'Belum')->countAllResults();
    }

    // Mengambil total jenis transaksi berdasarkan NPM ditampilkan di Tabel Mahasiswa
    public function Reward($npm)
    {
        return $this->where('kode_jenis', 101)->where('npm', $npm)->countAllResults();
    }
    public function Pembelian($npm)
    {
        return $this->where('kode_jenis', 102)->where('npm', $npm)->countAllResults();
    }
    public function Punishment($npm)
    {
        return $this->where('kode_jenis', 103)->where('npm', $npm)->countAllResults();
    }
    public function Misi($npm)
    {
        return $this->where('kode_jenis', 105)->where('npm', $npm)->countAllResults();
    }
    public function Konsultasi($npm)
    {
        return $this->where('kode_jenis', 106)->where('npm', $npm)->countAllResults();
    }

    // Mengambil kode_jenis
    public function getJenis($jenis = false)
    {
        return $this->where(['kode_jenis' => $jenis])->find();
    }

    // Menampilkan Data di Diagram Donut
    public function getTransactionsByCategory()
    {
        $builder = $this->builder();
        $builder->select('COUNT(*) as total, kode_jenis');
        $builder->groupBy('kode_jenis');
        return $builder->get()->getResultArray();
    }

    // Mengambil npm dan validasi untuk menampilkan data Reward di MarketPlace
    public function getRewardsByNpmAndValidation($npm, $validationStatus = 'Sudah')
    {
        return $this->where('npm', $npm) // Ambil berdasarkan NPM
            ->groupStart() // Mulai grup kondisi
            ->where('kode_jenis', '101') // Pastikan ini adalah kode untuk reward
            ->orWhere('kode_jenis', '105')
            ->orWhere('kode_jenis', '102') // Tambahkan kondisi untuk kode 105
            ->groupEnd() // Akhiri grup kondisi
            ->where('validation', $validationStatus) // Hanya ambil yang sudah divalidasi
            ->findAll();
    }

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'npm_mahasiswa', 'npm');
    }

    // Method untuk mengambil transaksi berdasarkan jenis
    public function getTransaksiByJenis($jenisId)
    {
        return $this->where('kode_jenis', $jenisId)->findAll();
    }
}
