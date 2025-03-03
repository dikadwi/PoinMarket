<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\PageModel;

class Transaksi extends BaseController
{
    protected $BadgesModel;
    protected $JenisTransaksiModel;
    protected $TransaksiModel;
    protected $DataTransaksiModel;
    protected $MahasiswaModel;
    protected $PageModel;
    protected $db;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->PageModel = new PageModel();
        $this->db = \Config\Database::connect();
    }

    public function index()
    // Benahi agar menampilkan data berdsarkan session/creator yg login
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        // Ambil data transaksi
        // $data_transaksi = $this->DataTransaksiModel->getDataTransaksi();

        // Menampilkan item yang dibuat berdasarkna session creator 
        $data_transaksi = $this->DataTransaksiModel->getDataTransaksi();
        if (in_array($session->get('username'), ['superadmin', 'admin'])) {
            $datatransaksi_user = $data_transaksi;
        } else {
            $datatransaksi_user = array_filter($data_transaksi, function ($t) use ($session) {
                return $t['creator'] == $session->get('username');
            });
        }

        // Ambil data mahasiswa berdasarkan NPM untuk Detail
        $mahasiswa = [];
        foreach ($data_transaksi as $data) {
            $mahasiswaData = $this->MahasiswaModel->getNamaByNpm($data['npm']);
            $mahasiswa[$data['npm']] = $mahasiswaData ? $mahasiswaData['nama'] : '-'; // Jika nama mahasiswa tidak ditemukan
        }

        $data = [
            'title' => 'Pesanan',
            'username' => $session->get('username'),
            // 'data_transaksi' => $this->DataTransaksiModel->getDataTransaksi(),
            // 'data_transaksi' => $data_transaksi,
            'data_transaksi' => $datatransaksi_user,
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'nama' => $mahasiswa,
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            // 'jenis' => $this->JenisTransaksiModel->getJenis(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/transaksi', $data);
    }

    public function reward()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['101'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        // Menampilkan item yang dibuat berdasarkna session creator 
        $transaksi = $this->DataTransaksiModel->getJenis($jenis);
        if (in_array($session->get('username'), ['superadmin', 'admin'])) {
            $datatransaksi_user = $transaksi;
        } else {
            $datatransaksi_user = array_filter($transaksi, function ($t) use ($session) {
                return $t['creator'] == $session->get('username');
            });
        }

        $data = [
            'username' => $session->get('username'),
            'title' => 'Rewards',
            // 'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'data_transaksi' => $datatransaksi_user,
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    public function pembelian()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['102'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        // Menampilkan item yang dibuat berdasarkna session creator 
        $transaksi = $this->DataTransaksiModel->getJenis($jenis);
        if (in_array($session->get('username'), ['superadmin', 'admin'])) {
            $datatransaksi_user = $transaksi;
        } else {
            $datatransaksi_user = array_filter($transaksi, function ($t) use ($session) {
                return $t['creator'] == $session->get('username');
            });
        }

        $data = [
            'username' => $session->get('username'),
            'title' => 'Pembelian',
            // 'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'data_transaksi' => $datatransaksi_user,
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    public function punishment()
    {
        $jenis = ['103'];

        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        // Menampilkan item yang dibuat berdasarkna session creator 
        $transaksi = $this->DataTransaksiModel->getJenis($jenis);
        if (in_array($session->get('username'), ['superadmin', 'admin'])) {
            $datatransaksi_user = $transaksi;
        } else {
            $datatransaksi_user = array_filter($transaksi, function ($t) use ($session) {
                return $t['creator'] == $session->get('username');
            });
        }

        $data = [
            'username' => $session->get('username'),
            'title' => 'Punishment',
            // 'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'data_transaksi' => $datatransaksi_user,
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    public function misi_tambah()
    {
        $jenis = ['105'];

        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        // Menampilkan item yang dibuat berdasarkna session creator 
        $transaksi = $this->DataTransaksiModel->getJenis($jenis);
        if (in_array($session->get('username'), ['superadmin', 'admin'])) {
            $datatransaksi_user = $transaksi;
        } else {
            $datatransaksi_user = array_filter($transaksi, function ($t) use ($session) {
                return $t['creator'] == $session->get('username');
            });
        }

        $data = [
            'username' => $session->get('username'),
            'title' => 'Misi',
            // 'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'data_transaksi' => $datatransaksi_user,
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    public function konsultasi()
    {
        $jenis = ['106'];

        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        // Menampilkan item yang dibuat berdasarkna session creator 
        $transaksi = $this->DataTransaksiModel->getJenis($jenis);
        if (in_array($session->get('username'), ['superadmin', 'admin'])) {
            $datatransaksi_user = $transaksi;
        } else {
            $datatransaksi_user = array_filter($transaksi, function ($t) use ($session) {
                return $t['creator'] == $session->get('username');
            });
        }

        $data = [
            'username' => $session->get('username'),
            'title' => 'Konsultasi',
            // 'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'data_transaksi' => $datatransaksi_user,
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/transaksi_byCode', $data);
    }

    // Save Transaksi (Logika untuk market place)
    // public function save_Transaksi()
    // {
    //     $npm = $this->request->getVar('npm');
    //     $poin_digunakan = $this->request->getVar('poin_digunakan');
    //     $poin_diberikan = $this->request->getVar('poin_diberikan');
    //     $gambar = $this->request->getVar('gambar');
    //     $jenis_transaksi = $this->request->getVar('kode_jenis');

    //     // Periksa apakah nilai `$npm` kosong
    //     if (empty($npm)) {
    //         session()->setFlashdata("gagal", "NPM tidak boleh kosong.");
    //         return redirect()->back();
    //     }

    //     // Periksa apakah nilai `$poin_digunakan` atau `$poin_diberikan` kosong
    //     if (empty($poin_digunakan) && empty($poin_diberikan)) {
    //         session()->setFlashdata("gagal", "Poin yang digunakan atau diberikan tidak boleh kosong.");
    //         return redirect()->back();
    //     }

    //     // Ambil informasi poin mahasiswa berdasarkan NPM dari tabel mahasiswa
    //     $mahasiswaData = $this->MahasiswaModel->where('npm', $npm)->first();

    //     if ($mahasiswaData) {
    //         $totalPoinMahasiswa = $mahasiswaData['point']; // Sesuaikan dengan nama kolom yang menyimpan total poin mahasiswa

    //         // Tentukan status claim berdasarkan jenis transaksi, atur validasi belum
    //         $validationStatus = '';
    //         $claim = '';

    //         if ($jenis_transaksi == '102' || $jenis_transaksi == '103') {
    //             // Jika jenis transaksi adalah 102 (Pembelian) atau 103 (Punishment), status claim langsung "Sudah".
    //             $validationStatus = 'Belum';
    //             $claim = 'Sudah';
    //         } else {
    //             // Untuk jenis transaksi lainnya, status claim adalah "Belum"
    //             $validationStatus = 'Belum';
    //             $claim = 'Belum';
    //         }

    //         // Proses pengurangan/penambahan poin berdasarkan jenis transaksi
    //         if ($jenis_transaksi == '102') {
    //             // Untuk transaksi 102 (Pembelian), periksa apakah poin cukup
    //             if ($totalPoinMahasiswa < $poin_digunakan) {
    //                 session()->setFlashdata("gagal1", "Poin tidak cukup untuk pembelian.");
    //                 return redirect()->back();
    //             } else {
    //                 $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
    //                 // Simpan data transaksi ke dalam tabel transaksi
    //                 $data_transaksi = [
    //                     'id_transaksi' => $this->request->getVar('id_transaksi'),
    //                     'kode_jenis' => $jenis_transaksi,
    //                     'nama_transaksi' => $this->request->getVar('nama_transaksi'),
    //                     'npm' => $mahasiswaData['npm'],
    //                     'poin_digunakan' => $poin_digunakan,
    //                     'poin_diberikan' => $poin_diberikan,
    //                     'gambar' => $gambar,
    //                     'tanggal_transaksi' => date('Y-m-d H:i:s'), // Sesuaikan dengan format tanggal
    //                     'validation' => $validationStatus, // Status validasi sesuai dengan jenis transaksi
    //                     'claim' => $claim, // Tambahkan claim ke data transaksi
    //                     'creator' => $this->request->getVar('creator'),
    //                 ];
    //                 // Simpan data transaksi ke dalam tabel transaksi
    //                 $this->DataTransaksiModel->insert($data_transaksi);
    //                 $this->MahasiswaModel->update($mahasiswaData['npm'], ['point' => $sisaPoin]);
    //                 session()->setFlashdata("sukses", "Transaksi Berhasil. Total poin sekarang: " . $sisaPoin);
    //             }
    //         } elseif ($jenis_transaksi == '103') {
    //             // Untuk transaksi 103 (Punishment), bisa mengurangi poin lebih dari total poin yang dimiliki (negatif)
    //             $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
    //             // Simpan data transaksi ke dalam tabel transaksi
    //             $data_transaksi = [
    //                 'id_transaksi' => $this->request->getVar('id_transaksi'),
    //                 'kode_jenis' => $jenis_transaksi,
    //                 'nama_transaksi' => $this->request->getVar('nama_transaksi'),
    //                 'npm' => $mahasiswaData['npm'],
    //                 'poin_digunakan' => $poin_digunakan,
    //                 'poin_diberikan' => $poin_diberikan,
    //                 'gambar' => $gambar,
    //                 'tanggal_transaksi' => date('Y-m-d H:i:s'), // Sesuaikan dengan format tanggal
    //                 'validation' => $validationStatus, // Status validasi sesuai dengan jenis transaksi
    //                 'claim' => $claim, // Tambahkan claim ke data transaksi
    //                 'creator' => $this->request->getVar('creator'),
    //             ];
    //             // Simpan data transaksi ke dalam tabel transaksi
    //             $this->DataTransaksiModel->insert($data_transaksi);
    //             $this->MahasiswaModel->update($mahasiswaData['npm'], ['point' => $sisaPoin]);
    //             session()->setFlashdata("sukses", "Transaksi Berhasil. Total poin sekarang: " . $sisaPoin);
    //         } else {
    //             // Untuk jenis transaksi lainnya ( 101, 105 / Reward, Misi), simpan data transaksi tanpa memeriksa poin
    //             $data_transaksi = [
    //                 'id_transaksi' => $this->request->getVar('id_transaksi'),
    //                 'kode_jenis' => $jenis_transaksi,
    //                 'nama_transaksi' => $this->request->getVar('nama_transaksi'),
    //                 'npm' => $mahasiswaData['npm'],
    //                 'poin_digunakan' => $poin_digunakan,
    //                 'poin_diberikan' => $poin_diberikan,
    //                 'gambar' => $gambar,
    //                 'tanggal_transaksi' => date('Y-m-d H:i:s'), // Sesuaikan dengan format tanggal
    //                 'validation' => $validationStatus, // Status validasi sesuai dengan jenis transaksi
    //                 'claim' => $claim, // Tambahkan claim ke data transaksi
    //                 'creator' => $this->request->getVar('creator'),
    //             ];
    //             // Simpan data transaksi ke dalam tabel transaksi
    //             $this->DataTransaksiModel->insert($data_transaksi);
    //             session()->setFlashdata("validasi", "Transaksi Ditambahkan.");
    //         }

    //         return redirect()->back();
    //     }
    // }

    // Point Berhasil dikurangi/ditambah & diupdate 
    // Reward : tambahkan validasi (oleh admin), poin bertambah ketika diclaim mahasiswa
    // Misi : tambahkan validasi (oleh admin & dosen), poin bertambah ketika diclaim mahasiswa /misi selesai 
    // Pembelian : tambahkan validasi (dosen&admin), poin berkurang, ketika validasi gagal poin yg digunakan kembali ke mahasiswa
    // Konsultasi tambahkan validasi (dosen&admin), point berkurang, ketika validasi gagal poin yg digunakan kembali ke mahasiswa
    // Punishment : tambahkan validasi (admin), jika berhasil poin mahasiswa berkurang, jika gagal tidak ada perubahan poin
     
    public function save_Transaksi()
    {
        // 1. Ambil data dari request
        $npm = $this->request->getVar('npm');
        $poin_digunakan = $this->request->getVar('poin_digunakan');
        $poin_diberikan = $this->request->getVar('poin_diberikan');
        $gambar = $this->request->getVar('gambar');
        $jenis_transaksi = $this->request->getVar('kode_jenis');
        $nama_transaksi = $this->request->getVar('nama_transaksi');
        $creator = $this->request->getVar('creator');
        $id_transaksi = $this->request->getVar('id_transaksi');

        // 2. Validasi input dasar
        if (empty($npm)) {
            session()->setFlashdata("gagal", "NPM tidak boleh kosong.");
            return redirect()->back();
        }

        if (empty($poin_digunakan) && empty($poin_diberikan)) {
            session()->setFlashdata("gagal", "Poin yang digunakan atau diberikan tidak boleh kosong.");
            return redirect()->back();
        }

        // 3. Ambil data mahasiswa
        $mahasiswaData = $this->MahasiswaModel->where('npm', $npm)->first();
        if (!$mahasiswaData) {
            session()->setFlashdata("gagal", "Data mahasiswa tidak ditemukan.");
            return redirect()->back();
        }

        // 4. Set status berdasarkan jenis transaksi
        $validationStatus = 'Wait';
        // $claim = ($jenis_transaksi == '102' || $jenis_transaksi == '103') ? 'Sudah' : 'Belum';
        // Mengindikasikan Poin sudah digunakan
        $claim = 'Wait';

        // 5. Hitung poin
        $totalPoinMahasiswa = (int)$mahasiswaData['point'];
        $sisaPoin = $totalPoinMahasiswa;

        // Validasi poin untuk pembelian
        if ($jenis_transaksi == '102' && $totalPoinMahasiswa < $poin_digunakan) {
            session()->setFlashdata("gagal", "Poin tidak cukup untuk pembelian.");
            return redirect()->back();
        }

         // Hitung sisa poin berdasarkan jenis transaksi
        if (in_array($jenis_transaksi, ['102', '106'])) {
            // Pengurangan poin untuk pembelian
            $sisaPoin = $totalPoinMahasiswa - (int)$poin_digunakan;
            $claim = 'Sudah'; // Set claim menjadi 'Sudah' untuk pembelian
        } elseif ($validationStatus !== 'Wait') {
            if (in_array($jenis_transaksi, ['103'])) {
                // Pengurangan poin untuk punishment dan konsultasi
                $sisaPoin = $totalPoinMahasiswa - (int)$poin_digunakan;
            } else {
                if (in_array($jenis_transaksi, ['101', '105'])) {
                     // Penambahan poin untuk reward dan misi
                    $sisaPoin = $totalPoinMahasiswa + (int)$poin_diberikan;
                }
               
            }

        }

        // 6. Siapkan data transaksi
        $data_transaksi = [
            'id_transaksi' => $id_transaksi,
            'kode_jenis' => $jenis_transaksi,
            'nama_transaksi' => $nama_transaksi,
            'npm' => $npm,
            'poin_digunakan' => $poin_digunakan,
            'poin_diberikan' => $poin_diberikan,
            'gambar' => $gambar,
            'tanggal_transaksi' => date('Y-m-d H:i:s'),
            'validation' => $validationStatus,
            'claim' => $claim,
            'creator' => $creator
        ];

        // 7. Mulai transaksi database
        $this->db->transStart();

        try {
            // Update poin mahasiswa
            $updateResult = $this->MahasiswaModel->where('npm', $npm)
                ->set('point', $sisaPoin)
                ->update();

            if ($updateResult === false) {
                throw new \Exception('Gagal mengupdate poin mahasiswa');
            }

            // Simpan data transaksi
            $insertResult = $this->DataTransaksiModel->insert($data_transaksi);
            if ($insertResult === false) {
                throw new \Exception('Gagal menyimpan data transaksi');
            }

            // Commit transaksi
            $this->db->transComplete();

            if ($this->db->transStatus() === false) {
                throw new \Exception('Transaksi database gagal');
            }

            // 8. Set pesan sukses
            $pesanSukses = "Transaksi berhasil ditambahkan. <br>";
            if (in_array($jenis_transaksi, ['101', '103'])) {
                $pesanSukses .= "Menunggu Validasi Admin";
            }
            // elseif (in_array($jenis_transaksi, ['102'])) {
            //     $pesanSukses .= "Pembelian berhasil "; 
            //     // $pesanSukses .= ". Total poin sekarang: " . $sisaPoin;
            // } 
            // else {
            //     $pesanSukses .= "Transaksi berhasil ditambahkan " . $poin_diberikan;
            //     // $pesanSukses .= ". Total poin sekarang: " . $sisaPoin;
            // }          
            
            session()->setFlashdata("sukses", $pesanSukses);
            return redirect()->back();

        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi error
            $this->db->transRollback();
            session()->setFlashdata("gagal", "Error: " . $e->getMessage());
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
                $jenis_transaksi = $transaksiData['kode_jenis'];
                // $statusValidasi = $transaksiData['validation']; // Ambil status validasi transaksi

                // Tentukan pesan berdasarkan jenis transaksi
                $jenisPesan = '';
                switch ($jenis_transaksi) {
                    case '101':
                        $jenisPesan = 'Reward';
                        break;
                    case '102':
                        $jenisPesan = 'Pembelian';
                        break;
                    case '103':
                        $jenisPesan = 'Punishment';
                        break;
                    case '105':
                        $jenisPesan = 'Misi Tambahan';
                        break;
                    default:
                        $jenisPesan = 'Transaksi';
                        break;
                }

                // // Jika transaksi belum divalidasi, tidak ada perubahan poin yang dilakukan
                // if ($statusValidasi == 'Belum') {
                //     session()->setFlashdata("sukses", "Data Berhasil Dihapus. Poin " . $mahasiswaData['npm'] . " Diperbarui.");
                //     $this->DataTransaksiModel->delete($kode_transaksi); // Hapus transaksi yang belum divalidasi
                //     return redirect()->back();
                // }
                // Hapus transaksi akan mengembalikan poin yang digunakan 
                // Proses perubahan poin berdasarkan jenis transaksi yang dihapus
                if ($jenis_transaksi == '101') {
                    // Reward (Tambah Poin) - Kurangi poin jika Reward dihapus
                    $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                } elseif ($jenis_transaksi == '102') {
                    // Pembelian (Kurangi Poin) - Tambah poin jika Pembelian dihapus
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
                } elseif ($jenis_transaksi == '103') {
                    // Punishment (Kurangi Poin) - Tambah poin jika Punishment dihapus
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
                } elseif ($jenis_transaksi == '105') {
                    // Misi Tambahan (Tambah Poin) - Kurangi poin jika Misi dihapus
                    $sisaPoin = $totalPoinMahasiswa - $poin_digunakan;
                } elseif ($jenis_transaksi == '106') {
                    // Konsultasi (Kurangi Poin) - Tambah poin jika Konsultasi dihapus
                    $sisaPoin = $totalPoinMahasiswa + $poin_digunakan;
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
                session()->setFlashdata("sukses", "" . $jenisPesan . " Berhasil Dihapus. <br> Poin " . $mahasiswaData['npm'] . " Diperbarui.");
            } else {
                session()->setFlashdata("gagal", "Mahasiswa terkait dengan transaksi ini tidak ditemukan.");
            }
        } else {
            session()->setFlashdata("gagal", "Data transaksi tidak ditemukan.");
        }

        return redirect()->back();
    }

    // Reward
    // Misi
    // Pembelian : Point Mhs berhasil diupdate
    // Punishment
    // Konsultasi
    // Tambahkan Kondisi jika validasi ditolak, point dikembalikan ke Mhs
    public function validasi($id_transaksi)
    {
        // Ambil data transaksi berdasarkan ID
        $transaksi = $this->DataTransaksiModel->find($id_transaksi);

        // Cek apakah data transaksi ditemukan
        if (!$transaksi) {
            session()->setFlashdata("gagal", "Data transaksi tidak ditemukan.");
            return redirect()->back();
        }

        // Ambil nilai validasi dari form
        $valid = $this->request->getPost('validation');

        // Validasi input
        if (!in_array($valid, ['Sudah', 'Belum'])) {
            session()->setFlashdata("gagal", "Pilihan validasi tidak valid.");
            return redirect()->back();
        }

        // Update status validasi
        $data = [
            'validation' => $valid
        ];

        // Simpan perubahan ke database
        $this->DataTransaksiModel->update($id_transaksi, $data);

        // Set flashdata sukses
        session()->setFlashdata("sukses", "Item berhasil divalidasi.");

        return redirect()->back();
    }
}
