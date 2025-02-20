<?php

namespace App\Controllers\API;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MahasiswaModel;
use App\Models\DataTransaksiModel;

class WalletAPI extends ResourceController
{
    protected $mahasiswaModel;
    protected $transaksiModel;
    protected $format = 'json';

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->transaksiModel = new DataTransaksiModel();
    }

    /**
     * Mendapatkan data wallet mahasiswa berdasarkan NPM
     */
    public function getWalletByNpm($npm)
    {
        $mahasiswa = $this->mahasiswaModel->findByNpm($npm);

        if (!$mahasiswa) {
            return $this->failNotFound('Mahasiswa tidak ditemukan');
        }

        // Ambil riwayat transaksi
        $transaksi = $this->transaksiModel->where('npm', $mahasiswa['npm'])
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();

        // Ambil posisi di leaderboard
        $leaderboard = $this->getLeaderboardPosition($npm);

        $response = [
            'status' => 200,
            'error' => false,
            'data' => [
                'mahasiswa' => [
                    'npm' => $mahasiswa['npm'],
                    'nama' => $mahasiswa['nama'],
                    'point' => $mahasiswa['point'],
                    'gaya_belajar' => $mahasiswa['gaya_belajar'],
                    'email' => $mahasiswa['email'],
                    'leaderboard_position' => $leaderboard['position'],
                    'total_participants' => $leaderboard['total']
                ],
                'riwayat_transaksi' => $transaksi
            ]
        ];

        return $this->respond($response);
    }

    /**
     * Mendapatkan saldo point mahasiswa
     */
    public function getPointBalance($npm)
    {
        $point = $this->mahasiswaModel->getPointByNpm($npm);

        if (!$point) {
            return $this->failNotFound('Mahasiswa tidak ditemukan');
        }

        return $this->respond([
            'status' => 200,
            'error' => false,
            'data' => [
                'point' => $point['point']
            ]
        ]);
    }

    /**
     * Mendapatkan riwayat transaksi wallet
     */
    public function getTransactionHistory($npm)
    {
        $mahasiswa = $this->mahasiswaModel->findByNpm($npm);

        if (!$mahasiswa) {
            return $this->failNotFound('Mahasiswa tidak ditemukan');
        }

        $transaksi = $this->transaksiModel->where('npm', $mahasiswa['npm'])
            ->orderBy('tanggal_transaksi', 'DESC')
            ->findAll();

        return $this->respond([
            'status' => 200,
            'error' => false,
            'data' => $transaksi
        ]);
    }

    /**
     * Mendapatkan leaderboard mahasiswa
     */
    public function getLeaderboard($limit = 10)
    {
        $leaderboard = $this->mahasiswaModel->select('npm, nama, point, gaya_belajar')
            ->orderBy('point', 'DESC')
            ->limit($limit)
            ->findAll();

        // Tambahkan peringkat ke setiap entri
        foreach ($leaderboard as $key => $value) {
            $leaderboard[$key]['rank'] = $key + 1;
        }

        return $this->respond([
            'status' => 200,
            'error' => false,
            'data' => $leaderboard
        ]);
    }

    /**
     * Mendapatkan posisi mahasiswa di leaderboard
     */
    private function getLeaderboardPosition($npm)
    {
        // Dapatkan semua mahasiswa diurutkan berdasarkan point
        $allStudents = $this->mahasiswaModel->orderBy('point', 'DESC')->findAll();
        
        $position = 0;
        $total = count($allStudents);

        // Cari posisi mahasiswa
        foreach ($allStudents as $key => $student) {
            if ($student['npm'] === $npm) {
                $position = $key + 1;
                break;
            }
        }

        return [
            'position' => $position,
            'total' => $total
        ];
    }
}
