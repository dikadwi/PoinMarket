<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class Register extends BaseController
{
    protected $MahasiswaModel;

    public function __construct()
    {
        $this->MahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        return view('auth/register');
    }

    public function add()
    {
        // Ambil data dari form
        $id = $this->request->getPost('id');
        $email = $this->request->getPost('email');
        $nama = $this->request->getPost('nama');
        $npm = $this->request->getPost('npm');
        $password = $this->request->getPost('password');

        $data = [
            'id' => $id,
            'email' => $email,
            'nama' => $nama,
            'npm' => $npm,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'point' => 30,
            // 'gaya_belajar' =>
        ];
        $this->MahasiswaModel->save($data);

        // Redirect ke halaman tertentu setelah registrasi
        return redirect()->to('/loginMhs');
    }

    public function registerMhs()
    {
        // Tampilkan form registrasi
        return view('auth/registerMhs');
    }
}
