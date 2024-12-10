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
        $data = [
            'username' => $session->get('username'),
            'title' => 'Data Pengguna',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
        ];
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, created_at, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();

        $data['users'] = $query->getResult();

        return view('PoinMarket_Admin/Page/user', $data);
    }
}
