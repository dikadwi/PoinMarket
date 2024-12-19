<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\DataTransaksiModel;
use App\Models\JenisModel;
use App\Models\JenisTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;

class Admin extends BaseController
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

    //Menampilkan halaman utama
    public function index()
    {
        $session = session();

        $data = [
            'title' => 'Dashboard',
            'username' => $session->get('username'),
            // 'totaldata' => $this->KendaraanModel->total(),
            'totalReward' => $this->DataTransaksiModel->totalReward(),
            'totalPembelian' => $this->DataTransaksiModel->totalPembelian(),
            'totalPunishment' => $this->DataTransaksiModel->totalPunishment(),
            'totalMisi' => $this->DataTransaksiModel->totalMisi(),
            'transactions' => $this->DataTransaksiModel->getTransactionsByCategory(),
            // 'totalBadges' => $this->BadgesModel->totalBadges(),
            // 'totaluser' => $this->MahasiswaModel->total(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'badges' => $this->BadgesModel->getBadges(),
            'mahasiswa' => $this->MahasiswaModel->getMhs(),
            'transaksi' => $this->TransaksiModel->getTransaksi(),
        ];

        return view('PoinMarket_Admin/index', $data);
    }

    //Menampilkan Profile user sesuai id
    public function profile($id)
    {

        $session = session();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Profile',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
        ];
        // $users = new \Myth\Auth\Models\UserModel();
        // $data['users'] = $users->findAll();

        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, created_at, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $builder->where('users.id', $id);
        $query = $builder->get();

        $data['user'] = $query->getRow();

        return view('PoinMarket_Admin/Page/profile', $data);
    }
}
