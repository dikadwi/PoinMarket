<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\DataTransaksiModel;
use App\Models\GayaBelajarModel;

class Mahasiswa extends BaseController
{
    protected $MahasiswaModel;
    protected $BadgesModel;
    protected $JenisTransaksiModel;
    protected $DataTransaksiModel;
    protected $GayaBelajarModel;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->GayaBelajarModel = new GayaBelajarModel();
    }

    public function Index()
    {
        $session = session();

        $npmList = $this->DataTransaksiModel->getNpmList();

        $data = [
            'title' => 'Data User',
            'username' => $session->get('username'),
            'mahasiswa' => $this->MahasiswaModel->getMhs(),
            'badges' => $this->BadgesModel->getBadges(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'npmList' => $npmList,
            'gaya_belajar' => $this->GayaBelajarModel->getGaya(),
        ];

        foreach ($npmList as $npm) {
            $data['reward'][$npm] = $this->DataTransaksiModel->Reward($npm);
            $data['pembelian'][$npm] = $this->DataTransaksiModel->Pembelian($npm);
            $data['punishment'][$npm] = $this->DataTransaksiModel->Punishment($npm);
            $data['misi'][$npm] = $this->DataTransaksiModel->Misi($npm);
        }

        return view('PoinMarket_Admin/Page/mahasiswa', $data);
    }

    public function save_Mhs()
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required|is_unique[mahasiswa.nama]',
                'errors' => [
                    'is_unique' => 'Data {value} sudah ada.' // {field} akan diganti dengan 'nama'
                ]
            ],
            'npm' => [
                'rules' => 'required|is_unique[mahasiswa.npm]',
                'errors' => [
                    'is_unique' => 'Data {value} sudah ada.' // {field} akan diganti dengan 'npm'
                ]
            ]
        ])) {
            $errorMessages = implode(' ', $this->validator->getErrors());
            return redirect()->back()->withInput()->with('gagal', $errorMessages);
            // return redirect()->back()->withInput()->with('gagal', 'Data Sudah Ada!');
        }

        $id = $this->request->getPost('id');
        $nama = $this->request->getPost('nama');
        $npm = $this->request->getPost('npm');
        $gaya_belajar = $this->request->getPost('gaya_belajar');
        $password = '12345678';

        $data = [
            'id' => $id,
            'nama' => $nama,
            'npm' => $npm,
            'gaya_belajar' => $gaya_belajar,
            'point' => 30,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        $this->MahasiswaModel->save($data);

        session()->setFlashdata("sukses", "Data $nama Berhasil Ditambah.");
        return redirect()->back();
    }

    public function update_Mhs($id)
    {
        $nama = $this->request->getPost('nama');
        $npm = $this->request->getPost('npm');
        $point = $this->request->getPost('point');

        $data = [
            'nama' => $nama,
            'npm' => $npm,
            'point' => $point
        ];

        $this->MahasiswaModel->update($id, $data);

        session()->setFlashdata("sukses", "Data Berhasil di Update.");
        return redirect()->back();
    }

    // Menghapus data mahasiswa dengan data_transaksi dengan npm yg sama 
    public function delete($id)
    {
        // Ambil data mahasiswa berdasarkan ID atau npm
        $mahasiswa = $this->MahasiswaModel->find($id);
        if (!$mahasiswa) {
            // Jika mahasiswa tidak ditemukan
            session()->setFlashdata('error', 'Data mahasiswa tidak ditemukan.');
            return redirect()->back();
        }

        // Hapus transaksi yang terkait dengan mahasiswa berdasarkan npm
        $this->DataTransaksiModel->where('npm', $mahasiswa['npm'])->delete();

        // Hapus data mahasiswa
        $this->MahasiswaModel->delete($id);

        // Berikan pesan sukses
        session()->setFlashdata('sukses', 'Data berhasil dihapus.');
        return redirect()->back();
    }
}
