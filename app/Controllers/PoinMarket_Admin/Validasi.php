<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;



class Validasi extends BaseController
{
    protected $BadgesModel;
    protected $JenisTransaksiModel;
    protected $TransaksiModel;
    protected $DataTransaksiModel;
    protected $MahasiswaModel;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Validasi',
            'data_transaksi' => $this->DataTransaksiModel->getDataTransaksi(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('PoinMarket_Admin/Page/validasi', $data);
    }

    // Fungsi untuk memvalidasi transaksi
    public function validasiTransaksi($id_transaksi)
    {
        // Ambil data transaksi berdasarkan id_transaksi yang diberikan
        $transaksiData = $this->DataTransaksiModel->find($id_transaksi);

        // Pastikan transaksi ditemukan dan status validasi masih 'Belum'
        if ($transaksiData && $transaksiData['validation'] == 'Belum') {
            // Ambil informasi mahasiswa
            $mahasiswaData = $this->MahasiswaModel->where('npm', $transaksiData['npm'])->first();

            // Pastikan mahasiswa ditemukan
            if ($mahasiswaData) {
                $totalPoinMahasiswa = $mahasiswaData['point'];
                $poin_digunakan = $transaksiData['poin_digunakan'];
                $jenis_transaksi = $transaksiData['jenis_transaksi'];

                // Update status validasi menjadi 'Tervalidasi'
                $this->DataTransaksiModel->update($id_transaksi, ['validation' => 'Sudah']);

                // Cek jenis transaksi dan lakukan perubahan poin
                if ($jenis_transaksi == '101') {  // Reward (Tambah Poin)
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
                } elseif ($jenis_transaksi == '102' || $jenis_transaksi == '103') {  // Pembelian atau Punishment (Kurangi Poin)
                    // Pastikan poin yang digunakan tidak melebihi total poin
                    if ($poin_digunakan > $totalPoinMahasiswa) {
                        session()->setFlashdata("gagal", "Poin yang digunakan melebihi poin yang tersedia.");
                        return redirect()->back();
                    }
                    // Kurangi total poin mahasiswa dengan poin yang digunakan
                    $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                } elseif ($jenis_transaksi == '105') {  // Misi Tambahan (Tambah Poin)
                    // Tambahkan poin mahasiswa dengan jumlah poin yang digunakan
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
                } else {
                    session()->setFlashdata("gagal", "Jenis transaksi tidak valid.");
                    return redirect()->back();
                }

                // Update poin mahasiswa setelah transaksi
                $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);

                session()->setFlashdata("sukses", "Transaksi berhasil divalidasi. Sisa poin: " . $sisaPoin);
                return redirect()->back();
            } else {
                session()->setFlashdata("gagal", "Mahasiswa dengan NPM tersebut tidak ditemukan.");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("gagal", "Transaksi tidak valid atau sudah tervalidasi.");
            return redirect()->back();
        }
    }
}
