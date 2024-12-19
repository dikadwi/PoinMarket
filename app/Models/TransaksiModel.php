<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{


    protected $table = 'transaksi';
    protected $primaryKey = 'id_transaksi';
    protected $allowedFields = ['id_transaksi', 'kode_jenis', 'nama_transaksi', 'detail', 'keterangan', 'poin_digunakan'];

    public function getTransaksi()
    {
        return $this->findAll();
    }

    // Mengambil kode_jenis 105
    public function totalReward()
    {
        return $this->where('kode_jenis', 101)->countAllResults();
    }

    // Mengambil kode_jenis 105
    public function totalPembelian()
    {
        return $this->where('kode_jenis', 102)->countAllResults();
    }

    // Mengambil kode_jenis 105
    public function totalPunishment()
    {
        return $this->where('kode_jenis', 103)->countAllResults();
    }

    // Mengambil kode_jenis 105
    public function totalMisi()
    {
        return $this->where('kode_jenis', 105)->countAllResults();
    }

    // mengambil kode_jenis
    public function getJenis($jenis = false)
    {
        return $this->where(['kode_jenis' => $jenis])->find();
    }

    // Join Table jenis transaksi
    public function getJ()
    {
        return $this->db->table('transaksi')
            ->select('transaksi.*, jenis_transaksi.nama_jenistransaksi')
            ->join('jenis_transaksi', 'jenis_transaksi.id_jenis = transaksi.id_jenis')
            ->get()
            ->getResultArray();
    }

    // Mengambil nama_transaksi
    public function cekNamaTransaksi($namaTransaksi)
    {
        return $this->where('nama_transaksi', $namaTransaksi)->first() !== null;
    }

    // Mengambil Poin berdasarkan nama_transaksi
    public function getPoinByTransaksi($namaTransaksi)
    {
        $namaTransaksiData = $this->where('nama_transaksi', $namaTransaksi)->first();

        if ($namaTransaksiData) {
            return $namaTransaksiData['poin_digunakan'];
        } else {
            return null;
        }
    }

    // Mengambil id_transaksi berdasarkan nama_transaksi
    public function getIdTransaksi($nama_transaksi)
    {
        // Ambil id_transaksi dari tabel transaksi berdasarkan nama_transaksi
        $transaksi = $this->where('nama_transaksi', $nama_transaksi)->first();

        if ($transaksi) {
            return $transaksi['id_transaksi']; // Sesuaikan dengan nama kolom id_transaksi pada tabel transaksi
        }

        return null; // Jika tidak ditemukan
    }

    // // Untuk generate id untuk menambahkan transaksi baru
    // public function getNextNomorUrut($kode_jenis)
    // {
    //     return $this->where('kode_jenis', $kode_jenis)->countAllResults() + 1;
    // }

    // public function getNextNomorUrut($kode_jenis)
    // {
    //     $lastRecord = $this->where('kode_jenis', $kode_jenis)
    //         ->orderBy('id_transaksi', 'DESC')
    //         ->first();

    //     if ($lastRecord) {
    //         $lastId = $lastRecord['id_transaksi'];
    //         $lastNumber = (int) substr($lastId, strlen($kode_jenis));
    //         return $lastNumber + 1;
    //     }

    //     return 1; // Nomor urut pertama jika belum ada transaksi
    // }
}
