<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Controllers\BaseController;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\JenisTransaksiModel;
use App\Models\TransaksiModel;

class Validasi extends BaseController
{
    protected $DataTransaksiModel;
    protected $MahasiswaModel;
    protected $JenisTransaksiModel;
    protected $TransaksiModel;

    public function __construct()
    {
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
    }

    // Menampilkan halaman validasi
    public function index()
    {
        $session = session();

        // Ambil data transaksi
        // $data_transaksi = $this->DataTransaksiModel->getDataTransaksi();

        // Ambil data transaksi yang validasi-nya "Belum"
        $data_transaksi = $this->DataTransaksiModel->getDataValidasi();

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = [];
        foreach ($data_transaksi as $data) {
            $mahasiswaData = $this->MahasiswaModel->getNamaByNpm($data['npm']);
            $mahasiswa[$data['npm']] = $mahasiswaData ? $mahasiswaData['nama'] : '-'; // Jika nama mahasiswa tidak ditemukan
        }

        $data = [
            'username' => $session->get('username'),
            'title' => 'Validasi',
            // 'data_transaksi' => $this->DataTransaksiModel->getDataTransaksi(),
            'data_transaksi' => $data_transaksi, // Hanya data transaksi yang validasi "Belum"
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'nama' => $mahasiswa

        ];
        return view('PoinMarket_Admin/page/validasi', $data);
    }

    // Mengambil semua data transaksi
    public function getAllTransaksi()
    {
        $data_transaksi = $this->DataTransaksiModel->findAll();
        return $this->response->setJSON($data_transaksi);
    }

    // Memvalidasi transaksi
    public function validasiTransaksi($id_transaksi)
    {
        // Ambil data transaksi berdasarkan id_transaksi yang diberikan
        $transaksiData = $this->DataTransaksiModel->find($id_transaksi);

        // Pastikan transaksi ditemukan dan status validasi masih 'Belum'
        if ($transaksiData && $transaksiData['validation'] == 'Belum') {
            // Update status validasi menjadi 'Sudah'
            $this->DataTransaksiModel->update($id_transaksi, ['validation' => 'Sudah']);

            // Set flash data untuk pesan sukses
            session()->setFlashdata('sukses', 'Transaksi berhasil divalidasi.');

            // Redirect kembali ke halaman  
            return redirect()->back();
            // return $this->response->setJSON(['status' => 'success', 'message' => 'Transaksi berhasil divalidasi.']);
        } else {
            // Set flash data untuk pesan error
            session()->setFlashdata('gagal', 'Transaksi tidak valid atau sudah tervalidasi.');

            // Redirect kembali ke halaman 
            return redirect()->back();
            // return $this->response->setJSON(['status' => 'error', 'message' => 'Transaksi tidak valid atau sudah tervalidasi.']);
        }
    }

    // Melihat detail transaksi berdasarkan id
    public function viewTransaksi($id_transaksi)
    {
        $transaksiData = $this->DataTransaksiModel->find($id_transaksi);

        if ($transaksiData) {
            return $this->response->setJSON($transaksiData);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Transaksi tidak ditemukan.']);
        }
    }

    // // Fungsi untuk memvalidasi transaksi
    // public function validasiTransaksi($id_transaksi)
    // {
    //     // Ambil data transaksi berdasarkan id_transaksi yang diberikan
    //     $transaksiData = $this->DataTransaksiModel->find($id_transaksi);

    //     // Pastikan transaksi ditemukan dan status validasi masih 'Belum'
    //     if ($transaksiData && $transaksiData['validation'] == 'Belum') {
    //         // Ambil informasi mahasiswa
    //         $mahasiswaData = $this->MahasiswaModel->where('npm', $transaksiData['npm'])->first();

    //         // Pastikan mahasiswa ditemukan
    //         if ($mahasiswaData) {
    //             $totalPoinMahasiswa = $mahasiswaData['point'];
    //             $poin_digunakan = $transaksiData['poin_digunakan'];
    //             $jenis_transaksi = $transaksiData['jenis_transaksi'];

    //             // Update status validasi menjadi 'Tervalidasi'
    //             $this->DataTransaksiModel->update($id_transaksi, ['validation' => 'Sudah']);

    //             // Cek jenis transaksi dan lakukan perubahan poin
    //             if ($jenis_transaksi == '101') {  // Reward (Tambah Poin)
    //                 $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
    //             } elseif ($jenis_transaksi == '102' || $jenis_transaksi == '103') {  // Pembelian atau Punishment (Kurangi Poin)
    //                 // Pastikan poin yang digunakan tidak melebihi total poin
    //                 if ($poin_digunakan > $totalPoinMahasiswa) {
    //                     session()->setFlashdata("gagal", "Poin yang digunakan melebihi poin yang tersedia.");
    //                     return redirect()->back();
    //                 }
    //                 // Kurangi total poin mahasiswa dengan poin yang digunakan
    //                 $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
    //             } elseif ($jenis_transaksi == '105') {  // Misi Tambahan (Tambah Poin)
    //                 // Tambahkan poin mahasiswa dengan jumlah poin yang digunakan
    //                 $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
    //             } else {
    //                 session()->setFlashdata("gagal", "Jenis transaksi tidak valid.");
    //                 return redirect()->back();
    //             }

    //             // Update poin mahasiswa setelah transaksi
    //             $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);

    //             session()->setFlashdata("sukses", "Transaksi berhasil divalidasi. Sisa poin: " . $sisaPoin);
    //             return redirect()->back();
    //         } else {
    //             session()->setFlashdata("gagal", "Mahasiswa dengan NPM tersebut tidak ditemukan.");
    //             return redirect()->back();
    //         }
    //     } else {
    //         session()->setFlashdata("gagal", "Transaksi tidak valid atau sudah tervalidasi.");
    //         return redirect()->back();
    //     }
    // }
}
