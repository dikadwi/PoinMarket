<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Controllers\LandingPage;
use App\Models\BadgesModel;
use App\Models\DataTransaksiModel;
use App\Models\JenisModel;
use App\Models\JenisTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\PageModel;

class Admin extends BaseController
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

    //Menampilkan halaman utama
    public function index()
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        $data = [
            'title' => 'Dashboard',
            'username' => $session->get('username'),
            'totalReward' => $this->DataTransaksiModel->totalReward(),
            'totalPembelian' => $this->DataTransaksiModel->totalPembelian(),
            'totalPunishment' => $this->DataTransaksiModel->totalPunishment(),
            'totalMisi' => $this->DataTransaksiModel->totalMisi(),
            'totalKonsultasi' => $this->DataTransaksiModel->totalKonsultasi(),
            'totalPemesanan' => $this->DataTransaksiModel->totalTransaksi(),
            'totalValidasi' => $this->DataTransaksiModel->totalValidasi(),
            'transactions' => $this->DataTransaksiModel->getTransactionsByCategory(),
            // 'totalBadges' => $this->BadgesModel->totalBadges(),
            'totalMhs' => $this->MahasiswaModel->total(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'badges' => $this->BadgesModel->getBadges(),
            'mahasiswa' => $this->MahasiswaModel->getMhs(),
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];

        return view('PoinMarket_Admin/index', $data);
    }

    //Menampilkan Profile user sesuai id
    public function profile($id)
    {

        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        $data = [
            'username' => $session->get('username'),
            'title' => 'Profile',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
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
