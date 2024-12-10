<?php

namespace App\Controllers;

use App\Models\LearningStyleModel;

class Learning extends BaseController
{
    protected $learningStyleModel;

    public function __construct()
    {
        // Memuat model LearningStyleModel
        $this->learningStyleModel = new LearningStyleModel();
    }

    public function index()
    {
        // Mengambil data siswa dan mengirimkannya ke view
        $data = [
            'title' => 'Detail',
            'students' => $this->learningStyleModel->get_students(),
            'npm' => $this->learningStyleModel->get_npm('npm'), // Pastikan 'npm' adalah nilai yang valid
        ];

        return view('learning', $data);
    }

    public function getLearningStyle($studentId)
    {
        // Mendapatkan data gamifikasi untuk siswa
        $studentData = $this->learningStyleModel->get_gamification_data($studentId);

        // Pastikan $studentData tidak null sebelum mengakses
        if ($studentData) {
            // Tentukan gaya belajar berdasarkan data gamifikasi
            $learningStyle = $this->learningStyleModel->determine_learning_style($studentData);

            // Mengembalikan gaya belajar dalam format JSON
            return $this->response->setJSON(['learningStyle' => $learningStyle]);
        } else {
            // Jika tidak ada data ditemukan
            return $this->response->setJSON(['error' => 'Data tidak ditemukan'], 404);
        }
    }
}
