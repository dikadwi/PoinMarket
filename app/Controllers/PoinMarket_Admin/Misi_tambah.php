<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;



class Misi_tambah extends BaseController
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
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['105'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'title' => 'Misi Tambahan',
            'username' => $session->get('username'),
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'jenis' => $this->JenisTransaksiModel->getJenis(),
        ];
        return view('PoinMarket_Admin/Page/misi_tambah', $data);
    }

    public function save_Misi()
    {
        $npm = $this->request->getVar('npm');
        $poin_digunakan = $this->request->getVar('poin_digunakan');

        // Periksa apakah nilai `$npm` kosong
        if (empty($npm)) {
            session()->setFlashdata("gagal", "NPM tidak boleh kosong.");
            return redirect()->back();
        }

        // Periksa apakah nilai `$poin_digunakan` kosong
        if (empty($poin_digunakan)) {
            session()->setFlashdata("gagal", "Poin yang digunakan tidak boleh kosong.");
            return redirect()->back();
        }

        // Ambil informasi poin mahasiswa berdasarkan NPM dari tabel mahasiswa
        $mahasiswaData = $this->MahasiswaModel->where('npm', $npm)->first();

        if ($mahasiswaData) {
            $totalPoinMahasiswa = $mahasiswaData['point']; // Sesuaikan dengan nama kolom yang menyimpan total poin mahasiswa

            // Pastikan poin yang akan digunakan tidak melebihi total poin yang dimiliki oleh mahasiswa
            if ($poin_digunakan <> $totalPoinMahasiswa) {

                // Siapkan data untuk disimpan ke dalam tabel transaksi
                $data_transaksi = [
                    'id_transaksi' => $this->request->getVar('id_transaksi'),
                    'jenis_transaksi' => $this->request->getVar('jenis_transaksi'),
                    'nama_transaksi' => $this->request->getVar('nama_transaksi'),
                    'npm' => $mahasiswaData['npm'],
                    'poin_digunakan' => $poin_digunakan,
                    'tanggal_transaksi' => date('Y-m-d H:i:s'), // Sesuaikan dengan format tanggal
                    'validation' => 'Belum'
                ];

                // Simpan data transaksi ke dalam tabel transaksi
                $this->DataTransaksiModel->insert($data_transaksi);

                // Periksa apakah kode_jenis transaksi adalah '101'
                if ($this->request->getVar('jenis_transaksi') == '101') {
                    // Tambahkan poin mahasiswa dengan jumlah poin yang digunakan
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
                    // $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);
                } else {
                    // Kurangi total poin mahasiswa dengan poin yang digunakan
                    $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                    // $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);
                }

                $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);

                session()->setFlashdata("sukses", "Transaksi berhasil. Sisa poin: " . $sisaPoin);
                return redirect()->back();
            } else {
                session()->setFlashdata("gagal", "Poin tidak cukup.");
                return redirect()->back();
            }
        } else {
            session()->setFlashdata("gagal", "Mahasiswa dengan NPM tersebut tidak ditemukan.");
            return redirect()->back();
        }
    }

    // Update data transaksi
    public function update_Misi($id)
    {
        $npm = $this->request->getPost('npm');
        $validation = $this->request->getPost('validation');

        $data = [
            'npm' => $npm,
            'validation' => $validation
        ];

        $this->DataTransaksiModel->update($id, $data);

        session()->setFlashdata("sukses", "Data Berhasil di Update.");
        return redirect()->back();
    }

    //Menghapus data transaksi dari database berdasarkan ID
    public function delete_Misi($kode_transaksi)
    {
        $this->DataTransaksiModel->delete($kode_transaksi);

        session()->setFlashdata("sukses", "Data Berhasil Dihapus.");

        return redirect()->back();
    }
}
