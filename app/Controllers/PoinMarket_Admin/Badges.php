<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;

class Badges extends BaseController
{
    protected $BadgesModel;
    protected $JenisTransaksiModel;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
    }

    public function index()
    {
        $session = session();

        $data = [
            'title' => 'Badges',
            'username' => $session->get('username'),
            'badges' => $this->BadgesModel->getBadges(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('PoinMarket_Admin/Page/badges', $data);
    }

    public function save_badges()
    {
        if (!$this->validate([
            'nama' => 'required|is_unique[badges.nama]'
        ])) {
            session()->setFlashdata("gagal", "Data Sudah Ada !");
        }

        $id_badges = $this->request->getPost('id_badges');
        $nama = $this->request->getPost('nama');
        $point = $this->request->getPost('point');
        $detail = $this->request->getPost('detail');
        $keterangan = $this->request->getPost('keterangan');
        $badges = file_get_contents($_FILES['badges']['tmp_name']);

        $data = [
            'id_badges' => $id_badges,
            'nama' => $nama,
            'point' => $point,
            'detail' => $detail,
            'keterangan' => $keterangan,
            'badges' => $badges
        ];
        $this->BadgesModel->save($data);

        session()->setFlashdata("sukses", "Data Berhasil Ditambah.");
        return redirect()->back();
    }

    public function update_badges($id_badges)
    {
        $nama = $this->request->getPost('nama');
        $point = $this->request->getPost('point');
        $detail = $this->request->getPost('detail');
        $keterangan = $this->request->getPost('keterangan');

        // Periksa apakah ada file gambar diunggah
        if ($this->request->getFile('badges')->isValid()) {
            $badges = file_get_contents($this->request->getFile('badges')->getTempName());
        } else {
            // Jika tidak ada file yang diunggah, tetap gunakan data lama
            $badgeData = $this->BadgesModel->find($id_badges);
            $badges = $badgeData['badges'];
        }

        $data = [
            'nama' => $nama,
            'point' => $point,
            'detail' => $detail,
            'keterangan' => $keterangan,
            'badges' => $badges
        ];

        $this->BadgesModel->update($id_badges, $data);

        session()->setFlashdata("sukses", "Data Berhasil Di Update.");
        return redirect()->back();
    }

    //Menghapus data dari database berdasarkan ID
    public function delete_badges($id_badges)
    {
        $this->BadgesModel->delete($id_badges);

        session()->setFlashdata("sukses", "Data Berhasil Dihapus.");

        return redirect()->back();
    }
}
