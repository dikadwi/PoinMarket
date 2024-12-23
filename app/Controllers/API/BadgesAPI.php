<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class BadgesAPI extends ResourceController
{
    // Model yang digunakan
    protected $modelName = 'App\Models\BadgesModel';
    protected $format = 'json';

    // Menampilkan semua data badge
    public function index()
    {
        $data = $this->model->findAll();

        // Memeriksa apakah data valid UTF-8
        foreach ($data as &$item) {
            // Mengonversi ke UTF-8 jika perlu
            // $item['nama'] = mb_convert_encoding($item['nama'], 'UTF-8', 'UTF-8');
            // $item['detail'] = mb_convert_encoding($item['detail'], 'UTF-8', 'UTF-8');
            // $item['keterangan'] = mb_convert_encoding($item['keterangan'], 'UTF-8', 'UTF-8');
            $item['badges'] = mb_convert_encoding($item['badges'], 'UTF-8', 'UTF-8');
        }

        if (empty($data)) {
            return $this->failNotFound('Tidak ada data badge ditemukan');
        }

        return $this->respond($data, 200);
    }

    // Menampilkan data badge berdasarkan ID
    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        // Mengonversi ke UTF-8 jika perlu
        // $data['nama'] = mb_convert_encoding($data['nama'], 'UTF-8', 'UTF-8');
        // $data['detail'] = mb_convert_encoding($data['detail'], 'UTF-8', 'UTF-8');
        // $data['keterangan'] = mb_convert_encoding($data['keterangan'], 'UTF-8', 'UTF-8');
        $data['badges'] = mb_convert_encoding($data['badges'], 'UTF-8', 'UTF-8');

        return $this->respond($data, 200);
    }

    // Menambahkan data badge baru
    public function create()
    {
        $input = $this->request->getJSON();

        // Memeriksa encoding
        if (!mb_check_encoding(json_encode($input), 'UTF-8')) {
            return $this->fail('Data mengandung karakter yang tidak valid', 400);
        }

        // Validasi input
        if (!$this->model->insert($input)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated(['status' => 'success', 'message' => 'Data badge berhasil ditambahkan']);
    }

    // Memperbarui data badge berdasarkan ID
    public function update($id = null)
    {
        $input = $this->request->getJSON();

        // Cek apakah ID valid
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        // Memeriksa encoding
        if (!mb_check_encoding(json_encode($input), 'UTF-8')) {
            return $this->fail('Data mengandung karakter yang tidak valid', 400);
        }

        // Validasi input
        if (!$this->model->update($id, $input)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond(['status' => 'success', 'message' => 'Data badge berhasil diperbarui']);
    }

    // Menghapus data badge berdasarkan ID
    public function delete($id = null)
    {
        // Cek apakah ID valid
        if (!$this->model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        // Menghapus data badge
        if (!$this->model->delete($id)) {
            return $this->fail('Gagal menghapus data badge', 500);
        }

        return $this->respondDeleted(['status' => 'success', 'message' => 'Data badge berhasil dihapus']);
    }
}
