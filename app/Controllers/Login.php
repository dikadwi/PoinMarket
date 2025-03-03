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

    public function login()
    {
        return view('auth/LoginPage');
    }

    public function loginMs()
    {
        return view('auth/LoginPageMhs');
    }

    public function registerMhs()
    {
        return view('auth/RegisterPageMhs');
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
       if ($this->request->getMethod() === 'options') {
        return $this->response->setStatusCode(200);
        }
        
        // Ambil data dari form login
        $npmOrUsername = $this->request->getPost('npm_or_username');
        $password = $this->request->getPost('password');

        // Log data yang diterima
        log_message('debug', 'Data login diterima: npm_or_username=' . $npmOrUsername);

        // Inisialisasi model Mahasiswa
        $mahasiswaModel = new MahasiswaModel();

        // Cari mahasiswa berdasarkan email
        $mahasiswa = $mahasiswaModel->where('npm', $npmOrUsername)
            ->orWhere('nama', $npmOrUsername)
            ->first();

        // Log hasil pencarian mahasiswa
        log_message('debug', 'Hasil pencarian mahasiswa: ' . json_encode($mahasiswa));

        // Jika mahasiswa dengan npm ditemukan 
        if ($mahasiswa) {
            // Verifikasi password
            if (password_verify($password, $mahasiswa['password'])) {
                // Login berhasil, simpan data ke session atau lakukan sesuatu yang diperlukan

                // Generate token
                $token = bin2hex(random_bytes(32)); // Token acak 32 karakter

                // Debug log sebelum update
                log_message('debug', 'NPM: ' . $mahasiswa['npm'] . ', Generated token: ' . $token);

                // Update token menggunakan method baru
                if ($mahasiswaModel->updateToken($mahasiswa['npm'], $token)) {
                    log_message('debug', 'Token berhasil disimpan ke database');

                    // Set session
                    $session = session();
                    $session->set([
                        'isLoggedIn' => true,
                        'user_id' => $mahasiswa['npm'],
                        'nama' => $mahasiswa['nama'],
                        'npm' => $mahasiswa['npm'],
                        'email' => $mahasiswa['email'],
                        'point' => $mahasiswa['point'],
                        'gaya_belajar' => $mahasiswa['gaya_belajar'],
                        'token' => $token // Simpan token di session
                    ]);
                 
                    log_message('debug', 'User logged in successfully: ' . $mahasiswa['npm']);
                    // return $this->response->setJSON(['token' => $token]);
                    return redirect()->to('/Role_User')->with('message', 'Selamat Datang di Market Point!');
                   
                } else {
                    log_message('error', 'Gagal update token untuk NPM: ' . $mahasiswa['npm']);
                    return redirect()->back()->with('pesan', 'Terjadi kesalahan saat login. Silakan coba lagi!');
                }
            } else {
                // Jika password salah, tampilkan pesan error
                log_message('warning', 'Password salah untuk NPM: ' . $npmOrUsername);
                return redirect()->back()->with('pesan', 'Password salah. Silakan coba lagi !');
            }
        } else {
            // Jika Username salah
            log_message('warning', 'Username/NPM tidak ditemukan: ' . $npmOrUsername);
            return redirect()->back()->with('pesan', 'Username / Npm Tidak Ditemukan. Silahkan Coba Lagi !');
        }
    }

     public function process_mobile()
    {
       if ($this->request->getMethod() === 'options') {
        return $this->response->setStatusCode(200);
        }
        
        // Ambil data dari form login
        $npmOrUsername = $this->request->getPost('npm_or_username');
        $password = $this->request->getPost('password');

        // Log data yang diterima
        log_message('debug', 'Data login diterima: npm_or_username=' . $npmOrUsername);

        // Inisialisasi model Mahasiswa
        $mahasiswaModel = new MahasiswaModel();

        // Cari mahasiswa berdasarkan email
        $mahasiswa = $mahasiswaModel->where('npm', $npmOrUsername)
            ->orWhere('nama', $npmOrUsername)
            ->first();

        // Log hasil pencarian mahasiswa
        log_message('debug', 'Hasil pencarian mahasiswa: ' . json_encode($mahasiswa));

        // Jika mahasiswa dengan npm ditemukan 
        if ($mahasiswa) {
            // Verifikasi password
            if (password_verify($password, $mahasiswa['password'])) {
                // Login berhasil, simpan data ke session atau lakukan sesuatu yang diperlukan

                // Generate token
                $token = bin2hex(random_bytes(32)); // Token acak 32 karakter

                // Debug log sebelum update
                log_message('debug', 'NPM: ' . $mahasiswa['npm'] . ', Generated token: ' . $token);

                // Update token menggunakan method baru
                if ($mahasiswaModel->updateToken($mahasiswa['npm'], $token)) {
                    log_message('debug', 'Token berhasil disimpan ke database');

                    // Set session
                    $session = session();
                    $session->set([
                        'isLoggedIn' => true,
                        'user_id' => $mahasiswa['npm'],
                        'nama' => $mahasiswa['nama'],
                        'npm' => $mahasiswa['npm'],
                        'email' => $mahasiswa['email'],
                        'point' => $mahasiswa['point'],
                        'gaya_belajar' => $mahasiswa['gaya_belajar'],
                        'token' => $token // Simpan token di session
                    ]);
                 
                    log_message('debug', 'User logged in successfully: ' . $mahasiswa['npm']);
                    return $this->response->setJSON(['token' => $token]);
                    // return redirect()->to('/Role_User')->with('message', 'Selamat Datang di Market Point!');
                   
                } else {
                    log_message('error', 'Gagal update token untuk NPM: ' . $mahasiswa['npm']);
                    return redirect()->back()->with('pesan', 'Terjadi kesalahan saat login. Silakan coba lagi!');
                }
            } else {
                // Jika password salah, tampilkan pesan error
                log_message('warning', 'Password salah untuk NPM: ' . $npmOrUsername);
                return redirect()->back()->with('pesan', 'Password salah. Silakan coba lagi !');
            }
        } else {
            // Jika Username salah
            log_message('warning', 'Username/NPM tidak ditemukan: ' . $npmOrUsername);
            return redirect()->back()->with('pesan', 'Username / Npm Tidak Ditemukan. Silahkan Coba Lagi !');
        }
    }

    public function logoutM()
    {
        $session = session();
        $session->remove('isLoggedIn');
        $session->remove('user_id');
        $session->remove('nama');
        $session->remove('npm');
        $session->remove('email');
        $session->remove('point');
        $session->remove('password');
        $session->remove('token');
        // $session->destroy();

        return redirect()->to('/loginMhs');
    }

    // public function logout()
    // {
    //     $session = session();
    //     $session->remove('isLoggedIn');
    //     $session->remove('user_id');

    //     return redirect()->to('/login');
    // }
}
