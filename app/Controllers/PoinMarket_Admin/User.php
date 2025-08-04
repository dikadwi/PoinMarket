<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\DataTransaksiModel;
use App\Models\JenisModel;
use App\Models\JenisTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\PageModel;

class User extends BaseController
{
    protected $JenisModel;
    protected $UserModel;
    protected $JenisTransaksiModel;
    protected $DataTransaksiModel;
    protected $TransaksiModel;
    protected $BadgesModel;
    protected $MahasiswaModel;
    protected $PageModel;


    public function __construct()
    {

        $this->JenisModel = new JenisModel();
        $this->UserModel = new UserModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->BadgesModel = new BadgesModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->PageModel = new PageModel();
    }

    // Menampilkan semua data user
    public function index()
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        $db = \Config\Database::connect();
        $roleBuilder = $db->table('auth_groups');
        $roleQuery = $roleBuilder->select('id, name')->get();
        $roles = $roleQuery->getResult();

        $data = [
            'username' => $session->get('username'),
            'title' => ' User',
            'roles' => $roles,
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        // Join Tabel Users dengan Tabel Auth untuk menampilkan role
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, created_at, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();

        return view('PoinMarket_Admin/Page/user', $data);
    }

    public function save_Users()
    {
        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Ambil data dari Form
            $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $password = 'loginsaja'; //Password Default

            // Generate token untuk user baru
            $token = bin2hex(random_bytes(32));

            // Gunakan Password class dari Myth\Auth untuk hash password
            $hashedPassword = \Myth\Auth\Password::hash($password);

            // Simpan data ke tabel users terlebih dahulu
            $userData = [
                'email' => $email,
                'username' => $username,
                'password_hash' => $hashedPassword,
                'created_at' => date('Y-m-d H:i:s'),
                'active' => 1,
                'token' => $token
            ];

            // Insert ke tabel users
            $userBuilder = $db->table('users');
            $userBuilder->insert($userData);
            
            // Ambil ID user yang baru dibuat
            $userId = $db->insertID();

            // Simpan relasi dengan role
            $roleId = $this->request->getPost('role_id');
            $roleData = [
                'user_id' => $userId,
                'group_id' => $roleId,
            ];

            // Insert ke tabel auth_groups_users
            $roleBuilder = $db->table('auth_groups_users');
            $roleBuilder->insert($roleData);

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata("gagal", "Gagal menyimpan data user.");
                return redirect()->back()->withInput();
            }

            session()->setFlashdata("sukses", "Data User Berhasil Ditambah dengan password default: loginsaja");
            return redirect()->back();

        } catch (\Exception $e) {
            session()->setFlashdata("gagal", "Error: " . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update_User()
    {
        try {
            $db = \Config\Database::connect();
            $db->transStart();

            // Ambil data dari form
            $userId = $this->request->getPost('user_id');
            $email = $this->request->getPost('email');
            $username = $this->request->getPost('username');
            $roleId = $this->request->getPost('role_id');
            $password = $this->request->getPost('password');

            // Siapkan data update
            $userData = [
                'email' => $email,
                'username' => $username,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            // Jika password diisi, update password
            if (!empty($password)) {
                $userData['password_hash'] = \Myth\Auth\Password::hash($password);
            }

            // Update data user
            $userBuilder = $db->table('users');
            $userBuilder->where('id', $userId);
            $userBuilder->update($userData);

            // Update role user
            $roleBuilder = $db->table('auth_groups_users');
            $roleBuilder->where('user_id', $userId);
            $roleBuilder->update(['group_id' => $roleId]);

            $db->transComplete();

            if ($db->transStatus() === false) {
                session()->setFlashdata("gagal", "Gagal mengupdate data user.");
                return redirect()->back();
            }

            session()->setFlashdata("sukses", "Data User Berhasil Diperbarui.");
            return redirect()->back();

        } catch (\Exception $e) {
            session()->setFlashdata("gagal", "Error: " . $e->getMessage());
            return redirect()->back();
        }
    }

    // Hanya relasi yang terhapus, data di tabel Users belum terhapus
    public function delete_User($id)
    {
        try {
            // Mulai transaksi database
            $db = \Config\Database::connect();
            $db->transStart();

            // Cek apakah user dengan ID tersebut ada
            $builder = $db->table('users');
            $user = $builder->where('id', $id)->get()->getRow();
            
            if (!$user) {
                session()->setFlashdata("gagal", "User dengan ID $id tidak ditemukan!");
                return redirect()->back();
            }

            // Hapus relasi role dari auth_groups_users berdasarkan user_id
            $roleBuilder = $db->table('auth_groups_users');
            $roleBuilder->where('user_id', $user->id);
            $roleBuilder->delete();

            // Hapus user dari tabel users berdasarkan id
            $userBuilder = $db->table('users');
            $userBuilder->where('id', $user->id);
            $userBuilder->delete();

            // Commit transaksi jika semua operasi berhasil
            $db->transComplete();

            if ($db->transStatus() === false) {
                // Jika ada error dalam transaksi
                session()->setFlashdata("gagal", "Terjadi kesalahan saat menghapus user.");
                return redirect()->back();
            }

            session()->setFlashdata("sukses", "User dengan username {$user->username} berhasil dihapus.");
            return redirect()->back();

        } catch (\Exception $e) {
            // Tangkap error jika terjadi
            session()->setFlashdata("gagal", "Gagal menghapus user: " . $e->getMessage());
            return redirect()->back();
        }
    }
}
