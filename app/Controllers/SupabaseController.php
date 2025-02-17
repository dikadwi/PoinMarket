<?php

namespace App\Controllers;

use App\Libraries\SupabaseAPI;
use CodeIgniter\RESTful\ResourceController;

class SupabaseController extends ResourceController
{
    private $supabase;

    public function __construct()
    {
        $this->supabase = new SupabaseAPI();
    }

    public function getUsers()
    {
        $users = $this->supabase->getData('users'); // Ganti 'users' dengan nama tabel 
        return $this->respond($users);
    }

    public function addUser()
    // ganti dengan fill form yang dibuat 
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com'
        ];

        $response = $this->supabase->insertData('users', $data); //simpan data ke tabel
        return $this->respond($response);
    }

    // public function update($id = null)
    // {
    //     $data = [];
    //     $response = $this->supabase->insertData('users', $data); //simpan data ke tabel
    //     return $this->respond($response);
    // }

    public function delete($id = null)
    {
        // Validasi ID pengguna
        if ($id === null || !is_numeric($id)) {
            return $this->failNotFound('ID pengguna tidak valid.');
        }

        // Hapus data pengguna dari Supabase
        $response = $this->supabase->deleteData('users', $id); // hapus data dari tabel

        // Jika berhasil, return response success
        if ($response) {
            return $this->respond(['status' => 'success', 'message' => 'Pengguna berhasil dihapus.'], 200);
        } else {
            return $this->respond(['status' => 'error', 'message' => 'Gagal menghapus pengguna.'], 500);
        }
    }
}
