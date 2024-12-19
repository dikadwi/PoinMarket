<?php

namespace App\Controllers;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\DataTransaksiModel;
use App\Models\TransaksiModel;

class Role_User extends BaseController
{
    protected $MahasiswaModel;
    protected $BadgesModel;
    protected $JenisTransaksiModel;
    protected $DataTransaksiModel;
    protected $TransaksiModel;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
    }
    public function index()
    {
        $session = session();

        //Mengambil npm yg sedang login
        $npm = $session->get('npm');

        // Mengambil total poin dari model Mahasiswa
        $mahasiswaData = $this->MahasiswaModel->getPointByNpm($npm);
        $totalPoints = $mahasiswaData['point'] ?? 0; // Menggunakan null coalescing operator untuk default 0

        // Memperbarui poin di session
        $session->set('point', $totalPoints);


        $data = [
            'title' => 'Dashboard',
            'username' => $session->get('username'),
            'id' => $session->get('user_id'),
            'npm' => $session->get('npm'),
            'email' => $session->get('email'),
            'point' => $totalPoints, // Menggunakan poin yang diambil
            'password' => $session->get('password'),
            'totalReward' => $this->DataTransaksiModel->Reward($npm),
            'totalPembelian' => $this->DataTransaksiModel->Pembelian($npm),
            'totalPunishment' => $this->DataTransaksiModel->Punishment($npm),
            'totalMisi' => $this->DataTransaksiModel->Misi($npm),
            'transactions' => $this->DataTransaksiModel->getTransactionsByCategory(),
            'totalBadges' => $this->BadgesModel->totalBadges(),
            'totaluser' => $this->MahasiswaModel->total(),
            'data_transaksi' => $this->DataTransaksiModel->getDataTransaksiUser($npm),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'badges' => $this->BadgesModel->getBadges(),
            'mahasiswa' => $this->MahasiswaModel->getMhs(),
        ];

        return view('User/index_user', $data);
    }

    public function detail()
    {
        $session = session();

        $data = array(
            'title' => 'Profile',
            'username' => $session->get('username'),
            'id' => $session->get('user_id'),
            'npm' => $session->get('npm'),
            'email' => $session->get('email'),
            'point' => $session->get('point'),
            'badges' => $this->BadgesModel->getBadges(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
        );

        return view('User/detail_profile', $data);
    }

    public function save_email()
    {
        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');

        $data = [
            'email' => $email
        ];

        $this->MahasiswaModel->update($id, $data);

        $session = session();
        $session->set('email', $email);

        session()->setFlashdata("sukses", "Email Berhasil ditambahkan.");
        return redirect()->back();
    }

    public function change_password()
    {
        $session = session();
        $id = $session->get('user_id');

        if ($this->request->getMethod() == 'post') {
            $old_password = $this->request->getPost('old_password');
            $new_password = $this->request->getPost('new_password');
            $confirm_password = $this->request->getPost('confirm_password');

            if ($new_password != $confirm_password) {
                session()->setFlashdata("gagal", "Konfirmasi Password tidak cocok.");
                return redirect()->back();
            }

            $user = $this->MahasiswaModel->find($id);
            if (!password_verify($old_password, $user['password'])) {
                session()->setFlashdata("gagal", "Password Lama tidak Cocok");
                return redirect()->back();
            }

            $data_update = [
                'password' => password_hash($new_password, PASSWORD_DEFAULT),
            ];

            $this->MahasiswaModel->update($id, $data_update);

            session()->setFlashdata("sukses", "Password Berhasil diubah.");

            return redirect()->back();
        }
    }
    public function Update_Profile()
    {
        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $npm = $this->request->getPost('npm');
        $email = $this->request->getPost('email');

        $data = [
            'nama' => $nama,
            'npm' => $npm,
            'email' => $email
        ];

        $this->MahasiswaModel->update($id, $data);

        // Update session data dengan data yg diupdate
        $session = session();
        $session->set('username', $nama);
        $session->set('npm', $npm);
        $session->set('email', $email);

        session()->setFlashdata("sukses", "Data Berhasil di Update.");
        return redirect()->back();
    }

    public function data_transaksi()
    {
        $session = session();

        //Mengambil npm yg sedang login
        $npm = $session->get('npm');

        $data = [
            'title' => 'Transaksi',
            'username' => $session->get('username'),
            'data_transaksi' => $this->DataTransaksiModel->getDataTransaksiUser($npm),
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'npm' => $this->MahasiswaModel->getMhs(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'jenis' => $this->JenisTransaksiModel->getJenis(),
        ];
        return view('User/transaksi/data_transaksi', $data);
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

            if ($jenis_transaksi == '102' || $jenis_transaksi == '103') {
                // Jika jenis transaksi adalah 102 (Pembelian) atau 103 (Punishment), status validasi langsung "Sudah"
                $validationStatus = 'Sudah';
            } else {
                // Untuk jenis transaksi lainnya, status validasi adalah "Belum"
                $validationStatus = 'Belum';
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
                        'validation' => $validationStatus // Status validasi sesuai dengan jenis transaksi
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
                    'validation' => $validationStatus // Status validasi sesuai dengan jenis transaksi
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
                    'validation' => $validationStatus // Status validasi sesuai dengan jenis transaksi
                ];
                // Simpan data transaksi ke dalam tabel transaksi
                $this->DataTransaksiModel->insert($data_transaksi);
                session()->setFlashdata("validasi", "Transaksi Ditambahkan.");
            }

            return redirect()->back();
        }
    }

    public function reward()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['101'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Rewards',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('User/transaksi/jenis_transaksi', $data);
    }

    public function pembelian()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['102'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Pembelian',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('User/transaksi/jenis_transaksi', $data);
    }

    public function punishment()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['103'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Punishment',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('User/transaksi/jenis_transaksi', $data);
    }

    public function misi()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['105'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Misi Tambahan',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('User/transaksi/jenis_transaksi', $data);
    }

    public function transaksi_reward()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['101'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Transaksi Rewards',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('User/transaksi/data_transaksi', $data);
    }

    public function transaksi_pembelian()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['102'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Transaksi Pembelian',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('User/transaksi/data_transaksi', $data);
    }

    public function transaksi_punishment()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['103'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Transaksi Punishment',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('User/transaksi/data_transaksi', $data);
    }

    public function transaksi_misi_tambah()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('data_transaksi');
        $jenis = ['105'];
        $builder->whereIn('jenis_transaksi', $jenis);

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Transaksi Misi Tambahan',
            'data_transaksi' => $this->DataTransaksiModel->getJenis($jenis),
            'transaksi' => $this->TransaksiModel->getJenis(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npm' => $this->MahasiswaModel->getMhs(),

        ];
        return view('User/transaksi/data_transaksi', $data);
    }

    public function badges()
    {
        $session = session();

        $data = [
            'title' => 'Badges',
            'username' => $session->get('username'),
            'badges' => $this->BadgesModel->getBadges(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('User/Badges/badges', $data);
    }
}
