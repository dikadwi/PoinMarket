<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\DataTransaksiModel;
use App\Models\JenisModel;
use App\Models\JenisTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class User extends BaseController
{
    protected $JenisModel;
    protected $UserModel;
    protected $JenisTransaksiModel;
    protected $DataTransaksiModel;
    protected $TransaksiModel;
    protected $BadgesModel;
    protected $MahasiswaModel;

    public function __construct()
    {

        $this->JenisModel = new JenisModel();
        $this->UserModel = new UserModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->BadgesModel = new BadgesModel();
        $this->MahasiswaModel = new MahasiswaModel();
    }

    // Menampilkan semua data user
    public function index()
    {
        $session = session();

        $db = \Config\Database::connect();
        $roleBuilder = $db->table('auth_groups');
        $roleQuery = $roleBuilder->select('id, name')->get();
        $roles = $roleQuery->getResult();

        $data = [
            'username' => $session->get('username'),
            'title' => ' User',
            'roles' => $roles,
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
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
        if (!$this->validate([
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|valid_email',
        ])) {
            session()->setFlashdata("gagal", "Data Sudah Ada !");
            return redirect()->back()->withInput();
        }

        // Ambil data dari Form
        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = '12345678';

        // Simpan data ke tabel
        $data = [
            'id' => $id,
            'email' => $email,
            'username' => $username,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->UserModel->save($data);
        $userId = $this->UserModel->insertID(); // Ambil ID pengguna yang baru ditambahkan

        // Simpan relasi dengan role
        $roleId = $this->request->getPost('role_id');
        $db = \Config\Database::connect();
        $roleBuilder = $db->table('auth_groups_users');
        $roleData = [
            'user_id' => $userId,
            'group_id' => $roleId,
        ];
        $roleBuilder->insert($roleData);

        session()->setFlashdata("sukses", "Data Berhasil Ditambah.");
        return redirect()->back();
    }

    // Hanya relasi yang terhapus, data di tabel Users belum terhapus
    public function delete_User($id)
    {
        // Cek apakah user dengan ID tersebut ada
        $user = $this->UserModel->find($id);
        if (!$user) {
            session()->setFlashdata("gagal", "User dengan ID $id tidak ditemukan!");
            return redirect()->back();
        }

        // Hapus relasi role dari auth_groups_users
        $db = \Config\Database::connect();
        $roleBuilder = $db->table('auth_groups_users');
        $roleBuilder->where('user_id', $id);
        $roleBuilder->delete();

        // Hapus user dari tabel users
        $deleteResult = $this->UserModel->delete($id);

        // Cek apakah penghapusan berhasil
        if ($deleteResult) {
            // Berikan flash message dengan nama username
            session()->setFlashdata("sukses", "User  dengan username {$user->username} berhasil dihapus.");
        } else {
            session()->setFlashdata("gagal", "Gagal menghapus user dengan ID $id.");
        }
        return redirect()->back();
    }
}
