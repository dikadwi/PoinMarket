<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LoginFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah pengguna sudah login
        $session = session();
        if (!$session->get('isLoggedIn')) {
            session()->setFlashdata('pesan', 'Harap Login terlebih dahulu !');
            return redirect()->to('/loginMhs'); // Jika belum login, redirect ke halaman login
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // ...
    }
}
