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
        
        // // Set response header untuk CORS
        // $this->response->setHeader('Access-Control-Allow-Origin', '*')
        //     ->setHeader('Access-Control-Allow-Headers', 'X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization')
        //     ->setHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, DELETE');
    }

    /**
     * Mendapatkan semua data wallet mahasiswa
     */
    public function getWallet()
    {
        if ($this->request->getMethod() === 'options') {
        return $this->response->setStatusCode(200);
        }
        $mahasiswaList = $this->mahasiswaModel->findAll();
        
        if (!$mahasiswaList) {
            return $this->failNotFound('Tidak ada data mahasiswa yang ditemukan');
        }
        
        $wallets = [];
        
        foreach ($mahasiswaList as $mahasiswa) {
            // Ambil riwayat transaksi
            $transaksi = $this->transaksiModel->where('npm', $mahasiswa['npm'])
                ->orderBy('tanggal_transaksi', 'DESC')
                ->findAll();
            
            // Ambil posisi di leaderboard
            $leaderboard = $this->getLeaderboardPosition($mahasiswa['npm']);
            
            $wallets[] = [
                'npm' => $mahasiswa['npm'],
                'nama' => $mahasiswa['nama'],
                'point' => $mahasiswa['point'],
                'gaya_belajar' => $mahasiswa['gaya_belajar'],
                'email' => $mahasiswa['email'],
                'leaderboard_position' => $leaderboard['position'],
                'total_participants' => $leaderboard['total'],
                'riwayat_transaksi' => $transaksi
            ];
        }
        
        return $this->respond([
            'status' => 200,
            'error' => false,
            'data' => $wallets
        ]);
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

    /**
     * Mendapatkan data wallet mahasiswa yang sedang login
     */
    public function getMyWallet()
    {
        try {
            // Debug session
            $session = session();
            log_message('debug', 'Session token: ' . ($session->get('token') ?? 'tidak ada'));

            // Ambil token dari header Authorization
            $token = $this->request->getHeaderLine('Authorization');
            log_message('debug', 'Raw Authorization header: ' . $token);

            // Coba ambil token dari berbagai sumber
            if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
                $token = $matches[1];
                log_message('debug', 'Token dari header: ' . $token);
            } else {
                // Coba ambil dari session
                $token = session()->get('token');
                log_message('debug', 'Token dari session: ' . $token);
                
                // Jika masih tidak ada, coba dari parameter URL
                if (empty($token)) {
                    $token = $this->request->getGet('token');
                    log_message('debug', 'Token dari URL: ' . $token);
                }
            }

            // Jika token masih tidak ada
            if (empty($token)) {
                return $this->response->setJSON([
                    'status' => 401,
                    'error' => true,
                    'message' => 'Token tidak ditemukan. Silakan Login Terlebih dahulu.'
                ])->setStatusCode(401);
            }

            // Cari mahasiswa berdasarkan token
            $mahasiswaModel = new \App\Models\MahasiswaModel();
            
            // Debug query
            $mahasiswa = $mahasiswaModel->where('token', $token)->first();
            log_message('debug', 'SQL: ' . $mahasiswaModel->getLastQuery());
            log_message('debug', 'Token yang dicari: ' . $token);
            log_message('debug', 'Hasil pencarian: ' . json_encode($mahasiswa));

            // Jika mahasiswa tidak ditemukan
            if (!$mahasiswa) {
                return $this->response->setJSON([
                    'status' => 401,
                    'error' => true,
                    'message' => 'Token tidak valid. Silakan login ulang.'
                ])->setStatusCode(401);
            }

            // Ambil data transaksi terbaru
            $transaksiModel = new \App\Models\DataTransaksiModel();
            $riwayat_transaksi = $transaksiModel->where('npm', $mahasiswa['npm'])
                ->orderBy('tanggal_transaksi', 'DESC')
                ->limit(5)
                ->find();

            // Hitung posisi di leaderboard
            $leaderboard_position = $mahasiswaModel->select('npm')
            ->where('point >', $mahasiswa['point'])
            ->countAllResults() + 1;

            $total_participants = $mahasiswaModel->countAll();
            $total_transaksi = $transaksiModel->where('npm', $mahasiswa['npm'])->countAllResults();

            // Format response
            $response = [
                'status' => 200,
                'error' => false,
                'data' => [
                    'mahasiswa' => [
                        'npm' => $mahasiswa['npm'],
                        'nama' => $mahasiswa['nama'],
                        'point' => (int)$mahasiswa['point'],
                        'gaya_belajar' => $mahasiswa['gaya_belajar'],
                        'email' => $mahasiswa['email'],
                        'leaderboard_position' => $leaderboard_position,
                        'total_participants' => $total_participants,
                        'total_transaksi' => $total_transaksi
                    ],
                    'riwayat_transaksi' => array_map(function($transaksi) {
                        return [
                            'id_transaksi' => $transaksi['id_transaksi'],
                            'jenis_transaksi' => $transaksi['kode_jenis'],  // Mengubah 'jenis' menjadi 'jenis_transaksi' untuk konsistensi
                            'jumlah_point' => in_array($transaksi['kode_jenis'], ['102', '106']) 
                                ? (int)$transaksi['poin_digunakan'] // Ambil poin_digunakan untuk Pembelian dan Konsultasi
                                : ($transaksi['kode_jenis'] == '103' 
                                    ? -(int)$transaksi['poin_digunakan'] // Ambil poin_digunakan untuk Punishment dengan tanda negatif
                                    : (int)$transaksi['poin_diberikan']), // Ambil poin_diberikan untuk Reward dan Misi
                            'keterangan' => $transaksi['nama_transaksi'],
                            'tanggal' => $transaksi['tanggal_transaksi']
                        ];
                    }, $riwayat_transaksi ?? [])
                ]
            ];

            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            log_message('error', '[WalletAPI.getMyWallet] ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => 500,
                'error' => true,
                'message' => 'Terjadi kesalahan internal server'
            ])->setStatusCode(500);
        }
    }

    /**
     * Mendapatkan data transaksi
     */
    public function getTransaksi()
    {
        try {
            // Debug session
            $session = session();
            log_message('debug', 'Session token: ' . ($session->get('token') ?? 'tidak ada'));

            // Ambil token dari header Authorization
            $token = $this->request->getHeaderLine('Authorization');
            log_message('debug', 'Raw Authorization header: ' . $token);
            
            // Coba ambil token dari berbagai sumber
            if (preg_match('/Bearer\s(\S+)/', $token, $matches)) {
                $token = $matches[1];
                log_message('debug', 'Token dari header: ' . $token);
            } else {
                // Coba ambil dari session
                $token = session()->get('token');
                log_message('debug', 'Token dari session: ' . $token);
                
                // Jika masih tidak ada, coba dari parameter URL
                if (empty($token)) {
                    $token = $this->request->getGet('token');
                    log_message('debug', 'Token dari URL: ' . $token);
                }
            }

            // Jika token masih tidak ada
            if (empty($token)) {
                return $this->response->setJSON([
                    'status' => 401,
                    'error' => true,
                    'message' => 'Token tidak ditemukan. Silakan Login Terlebih dahulu.'
                ])->setStatusCode(401);
            }

            // Cari mahasiswa berdasarkan token
            $mahasiswaModel = new \App\Models\MahasiswaModel();
            
            // Debug query
            $mahasiswa = $mahasiswaModel->where('token', $token)->first();
            log_message('debug', 'SQL: ' . $mahasiswaModel->getLastQuery());
            log_message('debug', 'Token yang dicari: ' . $token);
            log_message('debug', 'Hasil pencarian: ' . json_encode($mahasiswa));

            // Jika mahasiswa tidak ditemukan
            if (!$mahasiswa) {
                return $this->response->setJSON([
                    'status' => 401,
                    'error' => true,
                    'message' => 'Token tidak valid. Silakan login ulang.'
                ])->setStatusCode(401);
            }

            // Ambil data transaksi terbaru
            $transaksiModel = new \App\Models\DataTransaksiModel();
            $riwayat_transaksi = $transaksiModel->where('npm', $mahasiswa['npm'])
                ->orderBy('tanggal_transaksi', 'DESC')
                ->find();  // Menghapus limit untuk mendapatkan semua transaksi

            // Format response
            $response = [
                'status' => 200,
                'error' => false,
                'data' => [
                    'npm' => $mahasiswa['npm'],
                    'nama' => $mahasiswa['nama'],
                    'point' => (int)$mahasiswa['point'],
                    'total_transaksi' => count($riwayat_transaksi),
                    'riwayat_transaksi' => array_map(function($transaksi) {
                        return [
                            'id_transaksi' => $transaksi['id_transaksi'],
                            'jenis_transaksi' => $transaksi['kode_jenis'],  // Mengubah 'jenis' menjadi 'jenis_transaksi'
                            'jumlah_point' => ($transaksi['poin_diberikan'] != null) ? (int)$transaksi['poin_diberikan'] : (int)$transaksi['poin_digunakan'],
                            'keterangan' => $transaksi['nama_transaksi'],
                            'tanggal' => $transaksi['tanggal_transaksi']
                        ];
                    }, $riwayat_transaksi ?? [])
                ]
            ];

            return $this->response->setJSON($response);

        } catch (\Exception $e) {
            log_message('error', '[WalletAPI.getTransaksi] ' . $e->getMessage());  // Memperbaiki nama fungsi di log
            return $this->response->setJSON([
                'status' => 500,
                'error' => true,
                'message' => 'Terjadi kesalahan internal server'
            ])->setStatusCode(500);
        }
    }
}
