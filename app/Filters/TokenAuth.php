<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Models\MahasiswaModel;
use App\Models\UserModel;

class TokenAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Ambil token dari header Authorization
        $token = session()->get('token');

        // Jika token tidak ditemukan, kembalikan respons 401 Unauthorized
        if (empty($token)) {
            return Services::response()
                ->setStatusCode(401)
                ->setJSON(['error' => 'Token tidak ditemukan']);
        }

        // Validasi token dengan database mahasiswa
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswa = $mahasiswaModel->where('token', $token)->first();

        // Jika token ditemukan di tabel mahasiswa, lanjutkan ke controller
        if ($mahasiswa) {
            return;
        }

        // Jika token tidak ditemukan di tabel mahasiswa, cek di tabel users
        $usersModel = new UserModel();
        $user = $usersModel->where('token', $token)->first();

        // Jika token ditemukan di tabel users, lanjutkan ke controller
        if ($user) {
            return;
        }

        // Jika token tidak valid di kedua tabel, kembalikan respons 403 Forbidden
        return Services::response()
            ->setStatusCode(403)
            ->setJSON(['error' => 'Token tidak valid']);
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa setelah request
    }
}
