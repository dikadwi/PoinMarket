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
        $token = null;
        
        // Debug session
        $session = session();
        log_message('debug', 'Session token: ' . ($session->get('token') ?? 'tidak ada'));

        // Ambil token dari header Authorization
        $header = $request->getHeaderLine('Authorization');
        log_message('debug', 'Raw Authorization header: ' . $header);

        // Coba ambil token dari berbagai sumber
        if (preg_match('/Bearer\s(\S+)/', $header, $matches)) {
            $token = $matches[1];
            log_message('debug', 'Token dari header: ' . $token);
        } else {
            // Coba ambil dari session
            $token = $session->get('token');
            log_message('debug', 'Token dari session: ' . $token);
            
            // Jika masih tidak ada, coba dari parameter URL
            if (empty($token)) {
                $token = $request->getGet('token');
                log_message('debug', 'Token dari URL: ' . $token);
            }
        }

        // Jika token masih tidak ada
        if (empty($token)) {
            return Services::response()
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'message' => 'Token tidak ditemukan. Silahkan Login Terlebih dahulu untuk mendapatkan Token.'
                ]);
        }

        // // Validasi token dengan database mahasiswa
        // $mahasiswaModel = new MahasiswaModel();
        // $mahasiswa = $mahasiswaModel->where('token', $token)->first();

        // // Jika token ditemukan di tabel mahasiswa, lanjutkan ke controller
        // if ($mahasiswa) {
        //     return;
        // }

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
            ->setJSON([
                'status' => false,
                'message' => 'Token tidak valid'
            ]);
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada yang perlu dilakukan setelah request
    }
}