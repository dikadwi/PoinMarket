<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\QuisModel;
use App\Models\PageModel;

class Marketplace extends BaseController
{
    protected $TransaksiModel;
    protected $DataTransaksiModel;
    protected $MahasiswaModel;
    protected $QuisModel;
    protected $PageModel;

    public function __construct()
    {
        $this->TransaksiModel = new TransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->QuisModel = new QuisModel();
        $this->PageModel = new PageModel();
    }

    public function index()
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        $transaksi = $this->TransaksiModel->findAll(); // Pastikan model ini mengembalikan data yang sesuai

        $data = array(
            'title' => 'Marketplace',
            'username' => $session->get('username'),
            'transaksi' => $transaksi,
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        );
        return view('PoinMarket_Admin/Page/marketplace', $data);
    }

    public function edit()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $nama_transaksi = $this->request->getPost('nama_transaksi');
        $poin_digunakan = $this->request->getPost('poin_digunakan');
        $detail = $this->request->getPost('detail');

        // Lakukan validasi data jika diperlukan

        // Update data transaksi
        $data = [
            'nama_transaksi' => $nama_transaksi,
            'poin_digunakan' => $poin_digunakan,
            'detail' => $detail,
        ];

        $this->TransaksiModel->update($id_transaksi, $data);

        // Redirect atau tampilkan pesan sukses
        return redirect()->back()->with("sukses", "Item  <strong>$nama_transaksi</strong> berhasil diupdate.");
    }

    public function validasi()
    {
        $id_transaksi = $this->request->getPost('id_transaksi');
        $valid = $this->request->getPost('valid');

        // Cek apakah data transaksi ada
        $transaksi = $this->TransaksiModel->find($id_transaksi);
        if (!$transaksi) {
            return redirect()->back()->with('gagal', 'Data transaksi tidak ditemukan');
        }

        // Validasi data
        if ($valid == 'Validasi') {
            $transaksi['valid'] = 'Yes';
        } elseif ($valid == 'Tidak') {
            $transaksi['valid'] = 'No';
        } else {
            return redirect()->back()->with('gagal', 'Pilihan validasi tidak valid');
        }

        // Simpan perubahan
        $this->TransaksiModel->update($id_transaksi, $transaksi);

        return redirect()->back()->with('sukses', 'Item berhasil divalidasi');
    }
}
