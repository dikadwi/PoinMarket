<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\JenisTransaksiModel;

class Login extends BaseController
{

    protected $MahasiswaModel;
    protected $JenisTransaksiModel;


    public function __construct()
    {
        $this->MahasiswaModel = new MahasiswaModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
    }

    public function index()
    {
        return view('auth/login');
    }

    public function loginMhs()
    {
        return view('auth/loginMhs');
    }

    public function detail()
    {
        $session = session();

        $data = array(
            'title' => 'Detail',
            'username' => $session->get('username'),
            'npm' => $session->get('npm'),
            'email' => $session->get('email'),
            'point' => $session->get('point'),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
        );

        return view('auth/detail', $data);
    }

    public function process()
    {
        // Ambil data dari form login
        $npmOrUsername = $this->request->getPost('npm_or_username');
        $password = $this->request->getPost('password');

        // Inisialisasi model Mahasiswa
        $mahasiswaModel = new MahasiswaModel();

        // Cari mahasiswa berdasarkan email
        $mahasiswa = $mahasiswaModel->where('npm', $npmOrUsername)
            ->orWhere('nama', $npmOrUsername)
            ->first();

        // Jika mahasiswa dengan npm ditemukan 
        if ($mahasiswa) {
            // Verifikasi password
            if (password_verify($password, $mahasiswa['password'])) {
                // Login berhasil, simpan data ke session atau lakukan sesuatu yang diperlukan
                // Contoh: Simpan data ke session
                $session = session();
                $session->set('isLoggedIn', true);
                // Set sesuai dengan data mahasiswa dari tabel
                $session->set('user_id', $mahasiswa['id']);
                $session->set('username', $mahasiswa['nama']);
                $session->set('npm', $mahasiswa['npm']);
                $session->set('email', $mahasiswa['email']);
                $session->set('point', $mahasiswa['point']);

                return redirect()->to('/Role_User');
            }
        }
        return redirect()->back()->with('error', 'Login failed. Invalid NPM or password.');
    }


    public function logoutM()
    {
        $session = session();
        $session->remove('isLoggedIn');
        $session->remove('user_id');

        return redirect()->to('/loginMhs');
    }

    public function logout()
    {
        $session = session();
        $session->remove('isLoggedIn');
        $session->remove('user_id');

        return redirect()->to('/login');
    }
}
