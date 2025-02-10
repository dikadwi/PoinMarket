<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class UserAPI extends ResourceController
{
    // Model yang digunakan
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    // Menampilkan semua data user
    public function index()
    {
        $data = $this->model->findAll();
        return $this->respond($data, 200);
    }

    // Menampilkan data user berdasarkan ID
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }
        return $this->respond($data, 200);
    }

    // Menambahkan data user baru
    public function create()
    {
        // Ambil data JSON dari request
        $input = $this->request->getJSON();

        // Validasi input
        if (empty($input)) {
            return $this->fail('Data input tidak boleh kosong', 400);
        }

        // Coba insert data ke model
        try {
            if (!$this->model->insert($input)) {
                // Jika gagal, kembalikan error validasi
                return $this->failValidationErrors($this->model->errors());
            }

            // Jika berhasil, kembalikan respons sukses
            return $this->respondCreated([
                'status' => 'success',
                'message' => 'Data berhasil ditambahkan',
                'data' => $input // Opsional: kembalikan data yang baru saja ditambahkan
            ]);
        } catch (\Exception $e) {
            // Tangani exception yang tidak terduga
            return $this->failServerError('Terjadi kesalahan pada server: ' . $e->getMessage());
        }
    }

    // Memperbarui data user berdasarkan ID
    public function update($id = null)
    {
        $input = $this->request->getJSON();

        if (!$this->model->update($id, $input)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond([
            'id' => $id,
            'data' => $input,
            'status' => 'success',
            'message' => 'Data berhasil diperbarui',
        ]);
    }

    // Menghapus data user berdasarkan ID
    public function delete($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        if (!$this->model->delete($id)) {
            return $this->fail('Gagal menghapus data', 500);
        }

        return $this->respondDeleted([
            'id' => $id,
            'data' => $data,
            'status' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}
