<?php

namespace App\Controllers;

use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\QuisModel;

class Marketplace extends BaseController
{
    protected $TransaksiModel;
    protected $DataTransaksiModel;
    protected $MahasiswaModel;
    protected $QuisModel;

    public function __construct()
    {
        $this->TransaksiModel = new TransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->QuisModel = new QuisModel();
    }

    public function index()
    {
        $session = session();
        // $isLoggedIn = $session->get('isLoggedIn'); // Ambil status login dari sesi
        $username = $session->get('username');
        $npm = $session->get('npm');
        // $mahasiswa = $this->MahasiswaModel->where('nama', $username)->first();

        // Mengambil total poin dari model Mahasiswa
        $mahasiswaData = $this->MahasiswaModel->getPointByNpm($npm);
        $totalPoints = $mahasiswaData['point'] ?? 0; // Menggunakan null coalescing operator untuk default 0
        // Memperbarui poin di session
        $session->set('point', $totalPoints);

        // Ambil semua transaksi yang tersedia
        $transaksi = $this->TransaksiModel->findAll(); // Pastikan model ini mengembalikan data yang sesuai
        $datatransaksi = $this->DataTransaksiModel->getRewardsByNpmAndValidation($npm, 'Sudah'); // Ambil reward yang sudah divalidasi

        $data = [
            'title' => 'Market Point',
            // 'isLoggedIn' => $isLoggedIn,
            'npm' => $npm,
            'username' => $username,
            // 'mahasiswa' => $mahasiswa,
            'point' => $totalPoints,
            'transaksi' => $transaksi,
            'datatransaksi' => $datatransaksi
        ];

        return view('marketplace/index', $data);
    }

    // Fungsi untuk mengklaim reward
    public function claimReward()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            return redirect()->back()->with('error', 'User  not logged in.');
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('error', 'Mahasiswa not found.');
        }

        // Ambil poin yang digunakan untuk klaim dari request
        $poin_digunakan = $this->request->getPost('poin_digunakan');
        $transaksi_id = $this->request->getPost('id_transaksi'); // Ambil ID transaksi

        // Validasi poin yang cukup
        // if ($mahasiswa['point'] < $poin_digunakan) {
        //     return redirect()->back()->with('error', 'Not enough points to claim this reward.');
        // }

        // Tandai reward sebagai sudah diambil
        // Pastikan $transaksi_id adalah ID yang valid
        if ($transaksi_id) {
            // Coba untuk memperbarui status klaim
            $updateStatus = $this->DataTransaksiModel->update($transaksi_id, ['claim' => 'Sudah']); // Tandai reward sebagai diambil

            // Periksa apakah pembaruan status berhasil
            if ($updateStatus) {
                // Jika berhasil, update poin mahasiswa
                $sisaPoin = $mahasiswa['point'] + $poin_digunakan; // Hitung sisa poin
                $this->MahasiswaModel->update($mahasiswa['npm'], ['point' => $sisaPoin]); // Update poin mahasiswa

                return redirect()->back()->with('success', 'Reward claimed successfully! Total points now: ' . $sisaPoin);
            } else {
                return redirect()->back()->with('error', 'Failed to update claim status. Please try again.');
            }
        } else {
            return redirect()->back()->with('error', 'Invalid transaction ID.');
        }
    }

    // Fungsi Untuk Pembelian Produk
    public function buy()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            return redirect()->back()->with('gagal1', 'Silahkan Login Terlebih Dahulu !');
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('gagal', 'Mahasiswa Tidak ditemukan.');
        }

        $poin_digunakan = $this->request->getPost('poin_digunakan');

        // Validasi poin yang cukup
        if ($mahasiswa['point'] < $poin_digunakan) {
            return redirect()->back()->with('gagal1', 'Poin Tidak Cukup untuk Pembelian.');
        }

        // Proses pembelian
        $sisaPoin = $mahasiswa['point'] - $poin_digunakan;
        $this->MahasiswaModel->update($mahasiswa['npm'], ['point' => $sisaPoin]);

        // Simpan transaksi ke dalam tabel data_transaksi
        $data_transaksi = [
            'npm' => $npm,
            'kode_jenis' => '102', // Pembelian
            'nama_transaksi' => $this->request->getPost('nama_transaksi'), // Ambil nama transaksi dari input
            'poin_digunakan' => $poin_digunakan,
            'tanggal_transaksi' => date('Y-m-d H:i:s'), // Format tanggal, Atur Format Zona Waktu
            'validation' => 'Sudah', // Status validasi
            'claim' => 'Sudah' // Status claim
        ];

        // Simpan data transaksi
        $this->DataTransaksiModel->insert($data_transaksi);

        return redirect()->back()->with('sukses', 'Pembelian Berhasil ! Total points : ' . $sisaPoin);
    }

    // Fungsi untuk mengajukan misi tambahan
    public function misi_tambah()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            // return redirect()->back()->with('gagal', 'User  not logged in.');
            return redirect()->back()->with('gagal1', 'Silahkan Login Terlebih Dahulu .');
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('gagal1', 'Mahasiswa not found.');
        }

        // Pastikan request adalah POST
        if ($this->request->getMethod() === 'post') {
            // Ambil data dari form
            $nama_transaksi = $this->request->getPost('nama_transaksi');
            $poin_digunakan = $this->request->getPost('poin_digunakan');

            // Simpan transaksi misi tanpa menambahkan poin
            $data_transaksi = [
                'npm' => $npm,
                'kode_jenis' => '105', // Kode untuk misi tambahan
                'nama_transaksi' => $nama_transaksi,
                'poin_digunakan' => $poin_digunakan,
                'tanggal_transaksi' => date('Y-m-d H:i:s'), // Format tanggal
                'validation' => 'Belum', // Status validasi, misalnya 'Belum' sampai misi selesai
                'claim' => 'Belum' // Status klaim
            ];

            // Simpan data transaksi
            $this->DataTransaksiModel->insert($data_transaksi);

            // Set flashdata untuk pesan sukses
            return redirect()->back()->with('sukses', 'Misi berhasil diajukan. Tunggu konfirmasi untuk penambahan poin.');
        } else {
            // Set flashdata untuk pesan error jika request bukan POST
            return redirect()->back()->with('gagal1', 'Request tidak valid.');
        }
    }

    public function quis()
    {
        $session = session();
        $username = $session->get('username');

        $data = [
            'title' => 'Market Point',
            'username' => $username,
            'quis' => $this->QuisModel->findAll(), // Ambil semua data kuis dari database
        ];
        return view('User/quis', $data);
    }
    // Method untuk menangani pengiriman kuis
    public function submitQuiz()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            return redirect()->back()->with('gagal1', 'Silahkan login terlebih dahulu.');
        }

        // Jawaban yang benar
        $correctAnswers = [
            '1' => 'A', // Thomas Edison
            '2' => 'A', // Jakarta
            '3' => 'B', // 56
            '4' => 'C', // Soekarno
            '5' => 'C'  // Merkurius
        ];

        // Ambil jawaban dari pengguna
        $userAnswers = $this->request->getPost();

        // Hitung poin
        $totalPoints = 0;
        foreach ($correctAnswers as $question => $correctAnswer) {
            if (isset($userAnswers[$question]) && $userAnswers[$question] === $correctAnswer) {
                $totalPoints += 10; // 10 poin per jawaban benar
            }
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('gagal1', 'Mahasiswa tidak ditemukan.');
        }

        // Update poin mahasiswa
        $newPoints = $mahasiswa['point'] + $totalPoints;
        $this->MahasiswaModel->update($mahasiswa['npm'], ['point' => $newPoints]);

        // Set flashdata untuk pesan sukses
        return redirect()->back()->with('sukses', "Selamat! Anda mendapatkan $totalPoints poin tambahan. Total poin Anda sekarang adalah $newPoints.");
    }

    public function kirimJawaban()
    {
        $session = session();
        $npm = $session->get('npm');

        // Validasi NPM
        if ($npm === null) {
            return redirect()->back()->with('gagal1', 'Silahkan login terlebih dahulu.');
        }

        // Ambil semua data kuis dari tabel quis
        $quisData = $this->QuisModel->findAll(); // Pastikan model mengembalikan data yang sesuai

        // Siapkan array untuk menyimpan jawaban benar dan poin
        $correctAnswers = [];
        $pointsPerQuestion = [];

        foreach ($quisData as $quis) {
            $correctAnswers[$quis['id']] = $quis['jawaban_benar']; // Simpan jawaban benar
            $pointsPerQuestion[$quis['id']] = $quis['poin']; // Simpan poin per pertanyaan
        }

        // Ambil jawaban dari pengguna
        $userAnswers = $this->request->getPost('jawaban') ?? []; // Inisialisasi sebagai array kosong jika null

        // Periksa apakah ada jawaban yang dipilih
        if (empty($userAnswers)) {
            return redirect()->back()->with('gagal1', 'Silakan pilih jawaban yang tersedia.');
        }

        // Hitung poin
        $totalPoints = 0;
        foreach ($userAnswers as $idPertanyaan => $jawabanMahasiswa) {
            if (isset($correctAnswers[$idPertanyaan]) && $jawabanMahasiswa === $correctAnswers[$idPertanyaan]) {
                $totalPoints += $pointsPerQuestion[$idPertanyaan]; // Tambahkan poin berdasarkan jawaban benar
            }
        }

        // Ambil data mahasiswa berdasarkan NPM
        $mahasiswa = $this->MahasiswaModel->findByNpm($npm);
        if ($mahasiswa === null) {
            return redirect()->back()->with('gagal1', 'Mahasiswa tidak ditemukan.');
        }

        // Update poin mahasiswa
        $newPoints = $mahasiswa['point'] + $totalPoints;
        $this->MahasiswaModel->update($mahasiswa['npm'], ['point' => $newPoints]);

        // Set flashdata untuk pesan sukses
        return redirect()->back()->with('sukses', "Selamat! Anda mendapatkan $totalPoints poin tambahan. Total poin Anda sekarang adalah $newPoints.");
    }
}
