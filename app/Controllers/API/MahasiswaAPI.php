<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;

class MahasiswaAPI extends ResourceController
{
    protected $modelName = 'App\Models\MahasiswaModel';
    protected $format = 'json';

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
        $input = $this->request->getJSON();

        if (!$this->model->insert($input)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
    }

    public function update($id = null)
    {
        $input = $this->request->getJSON();

        if (!$this->model->update($id, $input)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    }

    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return $this->failNotFound('Data tidak ditemukan');
        }

        return $this->respondDeleted(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }
}
