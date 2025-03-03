<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class TransaksiAPI extends ResourceController
{
    protected $modelName = 'App\Models\DataTransaksiModel';
    protected $format = 'json';

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->session = session();
    // }

    // public function index()
    // {
    //     $user_type = $this->session->get('user_type');
    //     $user_data = $this->session->get('user_data');

    //     if ($user_type === 'mahasiswa') {
    //         // Jika user adalah mahasiswa, tampilkan hanya transaksi miliknya
    //         $data = $this->model->where('npm', $user_data['npm'])->findAll();
    //     } else if ($user_type === 'admin') {
    //         // Jika user adalah admin, tampilkan semua transaksi
    //         $data = $this->model->findAll();
    //     } else {
    //         return $this->failUnauthorized('Tidak memiliki akses');
    //     }

    //     return $this->respond([
    //         'status' => 200,
    //         'error' => false,
    //         'data' => $data
    //     ], 200);
    // }

    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }
        return $this->respond($data, 200);
    }


    public function create()
    {
        $user_type = $this->session->get('user_type');
        
        // Hanya admin yang bisa membuat transaksi
        if ($user_type !== 'admin') {
            return $this->failUnauthorized('Hanya admin yang dapat membuat transaksi');
        }

        $input = $this->request->getJSON();
        if (!$this->model->insert($input)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated([
            'status' => 200,
            'error' => false,
            'message' => 'Data berhasil ditambahkan',
            'data' => $input
        ]);
    }

    public function update($id = null)
    {
        $user_type = $this->session->get('user_type');
        
        // Hanya admin yang bisa mengupdate transaksi
        if ($user_type !== 'admin') {
            return $this->failUnauthorized('Hanya admin yang dapat mengupdate transaksi');
        }

        $input = $this->request->getJSON();
        if (!$this->model->update($id, $input)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'status' => 200,
            'error' => false,
            'message' => 'Data berhasil diupdate',
            'data' => $input
        ]);
    }

    public function delete($id = null)
    {
        $user_type = $this->session->get('user_type');
        
        // Hanya admin yang bisa menghapus transaksi
        if ($user_type !== 'admin') {
            return $this->failUnauthorized('Hanya admin yang dapat menghapus transaksi');
        }

        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        if (!$this->model->delete($id)) {
            return $this->fail('Gagal menghapus data');
        }

        return $this->respondDeleted([
            'status' => 200,
            'error' => false,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
