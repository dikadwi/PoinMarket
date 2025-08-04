<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\PageModel;

class Badges extends BaseController
{
    protected $BadgesModel;
    protected $JenisTransaksiModel;
    protected $PageModel;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->PageModel = new PageModel();
    }

    public function index()
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        $data = [
            'title' => 'Badges',
            'username' => $session->get('username'),
            'badges' => $this->BadgesModel->getBadges(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/badges', $data);
    }

    public function create_badges()
    {
        if (!$this->validate([
            'nama' => 'required|is_unique[badges.nama]'
        ])) {
            session()->setFlashdata("gagal", "Data Sudah Ada !");
            return redirect()->back();
        }

        $id_badges = $this->request->getPost('id_badges');
        $nama = $this->request->getPost('nama');
        $point = $this->request->getPost('point');
        $detail = $this->request->getPost('detail');
        $keterangan = $this->request->getPost('keterangan');

        // Mengambil gambar badges
        $gambar = $this->request->getFile('badges');
        $namaGambar = $gambar->getRandomName();
        $gambar->move('uploads/badges/', $namaGambar);

        $data = [
            'id_badges' => $id_badges,
            'nama' => $nama,
            'point' => $point,
            'detail' => $detail,
            'keterangan' => $keterangan,
            'badges' => $namaGambar
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
        $badges_lama = $this->request->getPost('badges_lama');
        $badges = $this->request->getFile('badges');

        $data = [
            'nama' => $nama,
            'point' => $point,
            'detail' => $detail,
            'keterangan' => $keterangan
        ];

        if ($badges->isValid()) {
            $namaBadges = $badges->getRandomName();
            $badges->move('uploads/badges/', $namaBadges);
            $data['badges'] = $namaBadges;
        } else {
            $data['badges'] = $badges_lama;
        }

        $this->BadgesModel->update($id_badges, $data);

        session()->setFlashdata("sukses", "Badges $nama berhasil diperbarui.");
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
