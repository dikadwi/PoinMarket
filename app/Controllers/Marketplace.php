<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;

class Marketplace extends BaseController
{
    protected $TransaksiModel;
    protected $DataTransaksiModel;
    protected $MahasiswaModel;

    public function __construct()
    {
        $this->TransaksiModel = new TransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $session = session();
        $username = $session->get('username');
        $npm = $session->get('npm');
        $mahasiswa = $this->MahasiswaModel->where('nama', $username)->first();

        // Ambil semua transaksi yang tersedia
        $transaksi = $this->TransaksiModel->findAll(); // Pastikan model ini mengembalikan data yang sesuai
        $datatransaksi = $this->DataTransaksiModel->getRewardsByNpmAndValidation($npm, 'Sudah'); // Ambil reward yang sudah divalidasi

        $data = [
            'title' => 'Marketplace',
            'npm' => $npm,
            'username' => $username,
            'mahasiswa' => $mahasiswa,
            'transaksi' => $transaksi,
            'datatransaksi' => $datatransaksi
        ];

        return view('marketplace/index', $data);
    }

    // Fungsi untuk mengklaim reward
    public function claimReward()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            return redirect()->back()->with('error', 'User  not logged in.');
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('error', 'Mahasiswa not found.');
        }

        // Ambil poin yang digunakan untuk klaim dari request
        $poin_digunakan = $this->request->getPost('poin_digunakan');
        $transaksi_id = $this->request->getPost('id_transaksi'); // Ambil ID transaksi

        // Validasi poin yang cukup
        if ($mahasiswa['point'] < $poin_digunakan) {
            return redirect()->back()->with('error', 'Not enough points to claim this reward.');
        }

        // Tandai reward sebagai sudah diambil
        // Pastikan $transaksi_id adalah ID yang valid
        if ($transaksi_id) {
            // Coba untuk memperbarui status klaim
            $updateStatus = $this->DataTransaksiModel->update($transaksi_id, ['claim' => 'Sudah']); // Tandai reward sebagai diambil

            // Periksa apakah pembaruan status berhasil
            if ($updateStatus) {
                // Jika berhasil, update poin mahasiswa
                $sisaPoin = $mahasiswa['point'] + $poin_digunakan; // Hitung sisa poin
                $this->MahasiswaModel->update($mahasiswa['id'], ['point' => $sisaPoin]); // Update poin mahasiswa

                return redirect()->back()->with('success', 'Reward claimed successfully! Total points now: ' . $sisaPoin);
            } else {
                return redirect()->back()->with('error', 'Failed to update claim status. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid transaction ID.');
        }
    }

    // Fungsi Untuk Pembelian Produk
    public function buy()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            return redirect()->back()->with('gagal', 'User belum log in.');
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('gagal', 'Mahasiswa Tidak ditemukan.');
        }

        $poin_digunakan = $this->request->getPost('poin_digunakan');

        // Validasi poin yang cukup
        if ($mahasiswa['point'] < $poin_digunakan) {
            return redirect()->back()->with('gagal1', 'Poin Tidak Cukup untuk Pembelian.');
        }

        // Proses pembelian
        $sisaPoin = $mahasiswa['point'] - $poin_digunakan;
        $this->MahasiswaModel->update($mahasiswa['id'], ['point' => $sisaPoin]);

        // Simpan transaksi ke dalam tabel data_transaksi
        $data_transaksi = [
            'npm' => $npm,
            'jenis_transaksi' => '102', // Pembelian
            'nama_transaksi' => $this->request->getPost('nama_transaksi'), // Ambil nama transaksi dari input
            'poin_digunakan' => $poin_digunakan,
            'tanggal_transaksi' => date('Y-m-d H:i:s'), // Format tanggal, Atur Format Zona Waktu
            'validation' => 'Sudah', // Status validasi
            'claim' => 'Sudah' // Status claim
        ];

        // Simpan data transaksi
        $this->DataTransaksiModel->insert($data_transaksi);

        return redirect()->back()->with('sukses', 'Pembelian Berhasil ! Total points : ' . $sisaPoin);
    }

    // Fungsi untuk mengajukan misi tambahan
    public function misi_tambah()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            return redirect()->back()->with('gagal', 'User  not logged in.');
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('gagal', 'Mahasiswa not found.');
        }

        // Pastikan request adalah POST
        if ($this->request->getMethod() === 'post') {
            // Ambil data dari form
            $nama_transaksi = $this->request->getPost('nama_transaksi');
            $poin_digunakan = $this->request->getPost('poin_digunakan');

            // Simpan transaksi misi tanpa menambahkan poin
            $data_transaksi = [
                'npm' => $npm,
                'jenis_transaksi' => '105', // Kode untuk misi tambahan
                'nama_transaksi' => $nama_transaksi,
                'poin_digunakan' => $poin_digunakan,
                'tanggal_transaksi' => date('Y-m-d H:i:s'), // Format tanggal
                'validation' => 'Belum', // Status validasi, misalnya 'Belum' sampai misi selesai
                'claim' => 'Belum' // Status klaim
            ];

            // Simpan data transaksi
            $this->DataTransaksiModel->insert($data_transaksi);

            // Set flashdata untuk pesan sukses
            return redirect()->back()->with('sukses', 'Misi berhasil diajukan. Tunggu konfirmasi untuk penambahan poin.');
        } else {
            // Set flashdata untuk pesan error jika request bukan POST
            return redirect()->back()->with('gagal', 'Request tidak valid.');
        }
    }
}
