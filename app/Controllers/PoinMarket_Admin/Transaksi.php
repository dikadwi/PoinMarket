<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;




class Transaksi extends BaseController
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

        // Ambil data transaksi
        $data_transaksi = $this->DataTransaksiModel->getDataTransaksi();

        // Ambil data mahasiswa berdasarkan NPM untuk Detail
        $mahasiswa = [];
        foreach ($data_transaksi as $data) {
            $mahasiswaData = $this->MahasiswaModel->getNamaByNpm($data['npm']);
            $mahasiswa[$data['npm']] = $mahasiswaData ? $mahasiswaData['nama'] : '-'; // Jika nama mahasiswa tidak ditemukan
        }

        $data = [
            'title' => 'Transaksi',
            'username' => $session->get('username'),
            // 'data_transaksi' => $this->DataTransaksiModel->getDataTransaksi(),
            'data_transaksi' => $data_transaksi,
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'nama' => $mahasiswa,
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'jenis' => $this->JenisTransaksiModel->getJenis(),
        ];
        return view('PoinMarket_Admin/Page/transaksi', $data);
    }

    public function reward()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['101'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Rewards',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    public function pembelian()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['102'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Pembelian',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    public function punishment()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['103'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Punishment',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    public function misi_tambah()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['105'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Misi Tambahan',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    // Save Transaksi (Logika untuk market place)
    public function save_Transaksi()
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

            // Tentukan status validasi berdasarkan jenis transaksi
            $jenis_transaksi = $this->request->getVar('jenis_transaksi');
            $validationStatus = '';
            $claim = '';

            if ($jenis_transaksi == '102' || $jenis_transaksi == '103') {
                // Jika jenis transaksi adalah 102 (Pembelian) atau 103 (Punishment), status validasi langsung "Sudah"
                $validationStatus = 'Sudah';
                $claim = 'Sudah';
            } else {
                // Untuk jenis transaksi lainnya, status validasi adalah "Belum"
                $validationStatus = 'Belum';
                $claim = 'Belum';
            }

            // Proses pengurangan/penambahan poin berdasarkan jenis transaksi
            if ($jenis_transaksi == '102') {
                // Untuk transaksi 102 (Pembelian), periksa apakah poin cukup
                if ($totalPoinMahasiswa < $poin_digunakan) {
                    session()->setFlashdata("gagal1", "Poin tidak cukup untuk pembelian.");
                    return redirect()->back();
                } else {
                    $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                    // Simpan data transaksi ke dalam tabel transaksi
                    $data_transaksi = [
                        'id_transaksi' => $this->request->getVar('id_transaksi'),
                        'jenis_transaksi' => $jenis_transaksi,
                        'nama_transaksi' => $this->request->getVar('nama_transaksi'),
                        'npm' => $mahasiswaData['npm'],
                        'poin_digunakan' => $poin_digunakan,
                        'tanggal_transaksi' => date('Y-m-d H:i:s'), // Sesuaikan dengan format tanggal
                        'validation' => $validationStatus, // Status validasi sesuai dengan jenis transaksi
                        'claim' => $claim // Tambahkan claim ke data transaksi
                    ];
                    // Simpan data transaksi ke dalam tabel transaksi
                    $this->DataTransaksiModel->insert($data_transaksi);
                    $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);
                    session()->setFlashdata("sukses", "Transaksi Berhasil. Total poin sekarang: " . $sisaPoin);
                }
            } elseif ($jenis_transaksi == '103') {
                // Untuk transaksi 103 (Punishment), bisa mengurangi poin lebih dari total poin yang dimiliki (negatif)
                $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                // Simpan data transaksi ke dalam tabel transaksi
                $data_transaksi = [
                    'id_transaksi' => $this->request->getVar('id_transaksi'),
                    'jenis_transaksi' => $jenis_transaksi,
                    'nama_transaksi' => $this->request->getVar('nama_transaksi'),
                    'npm' => $mahasiswaData['npm'],
                    'poin_digunakan' => $poin_digunakan,
                    'tanggal_transaksi' => date('Y-m-d H:i:s'), // Sesuaikan dengan format tanggal
                    'validation' => $validationStatus, // Status validasi sesuai dengan jenis transaksi
                    'claim' => $claim // Tambahkan claim ke data transaksi
                ];
                // Simpan data transaksi ke dalam tabel transaksi
                $this->DataTransaksiModel->insert($data_transaksi);
                $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);
                session()->setFlashdata("sukses", "Transaksi Berhasil. Total poin sekarang: " . $sisaPoin);
            } else {
                // Untuk jenis transaksi lainnya ( 101, 105), simpan data transaksi tanpa memeriksa poin
                $data_transaksi = [
                    'id_transaksi' => $this->request->getVar('id_transaksi'),
                    'jenis_transaksi' => $jenis_transaksi,
                    'nama_transaksi' => $this->request->getVar('nama_transaksi'),
                    'npm' => $mahasiswaData['npm'],
                    'poin_digunakan' => $poin_digunakan,
                    'tanggal_transaksi' => date('Y-m-d H:i:s'), // Sesuaikan dengan format tanggal
                    'validation' => $validationStatus, // Status validasi sesuai dengan jenis transaksi
                    'claim' => $claim // Tambahkan claim ke data transaksi
                ];
                // Simpan data transaksi ke dalam tabel transaksi
                $this->DataTransaksiModel->insert($data_transaksi);
                session()->setFlashdata("validasi", "Transaksi Ditambahkan.");
            }

            return redirect()->back();
        }
    }

    // Update data transaksi
    public function update_Transaksi($id)
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

    // Menghapus data Transaksi dan mengurangi point
    public function delete_Transaksi($kode_transaksi)
    {
        // Ambil data transaksi berdasarkan kode_transaksi
        $transaksiData = $this->DataTransaksiModel->find($kode_transaksi);

        // Pastikan transaksi ditemukan
        if ($transaksiData) {
            // Ambil informasi mahasiswa terkait transaksi
            $mahasiswaData = $this->MahasiswaModel->where('npm', $transaksiData['npm'])->first();

            // Pastikan mahasiswa ditemukan
            if ($mahasiswaData) {
                $totalPoinMahasiswa = $mahasiswaData['point'];
                $poin_digunakan = $transaksiData['poin_digunakan'];
                $jenis_transaksi = $transaksiData['jenis_transaksi'];
                $statusValidasi = $transaksiData['validation']; // Ambil status validasi transaksi

                // Jika transaksi belum divalidasi, tidak ada perubahan poin yang dilakukan
                if ($statusValidasi == 'Belum') {
                    session()->setFlashdata("sukses", "Data Berhasil Dihapus. Poin " . $mahasiswaData['npm'] . " Diperbarui.");
                    $this->DataTransaksiModel->delete($kode_transaksi); // Hapus transaksi yang belum divalidasi
                    return redirect()->back();
                }

                // Proses perubahan poin berdasarkan jenis transaksi yang dihapus
                if ($jenis_transaksi == '101') {
                    // Reward (Tambah Poin) - Kurangi poin jika transaksi dihapus
                    $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                } elseif ($jenis_transaksi == '102') {
                    // Pembelian (Kurangi Poin) - Tambah poin jika transaksi dihapus
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
                } elseif ($jenis_transaksi == '103') {
                    // Punishment (Kurangi Poin) - Tambah poin jika transaksi dihapus
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
                } elseif ($jenis_transaksi == '105') {
                    // Misi Tambahan (Tambah Poin) - Kurangi poin jika transaksi dihapus
                    $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                } else {
                    // Jika jenis transaksi tidak valid, set flashdata gagal
                    session()->setFlashdata("gagal", "Jenis transaksi tidak valid.");
                    return redirect()->back();
                }

                // Update poin mahasiswa setelah perubahan
                $this->MahasiswaModel->update($mahasiswaData['id'], ['point' => $sisaPoin]);

                // Hapus data transaksi dari tabel
                $this->DataTransaksiModel->delete($kode_transaksi);

                // Set flashdata sukses dengan tambahan npm dan nama mahasiswa
                session()->setFlashdata("sukses", "Data Berhasil Dihapus. Poin " . $mahasiswaData['npm'] . " Diperbarui.");
            } else {
                session()->setFlashdata("gagal", "Mahasiswa terkait dengan transaksi ini tidak ditemukan.");
            }
        } else {
            session()->setFlashdata("gagal", "Data transaksi tidak ditemukan.");
        }

        return redirect()->back();
    }
}
