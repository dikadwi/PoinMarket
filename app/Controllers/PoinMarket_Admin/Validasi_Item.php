<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;
use App\Models\PageModel;
use CodeIgniter\HTTP\Request;


class Validasi_Item extends BaseController
{
    protected $BadgesModel;
    protected $JenisTransaksiModel;
    protected $TransaksiModel;
    protected $DataTransaksiModel;
    protected $MahasiswaModel;
    protected $PageModel;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->PageModel = new PageModel();
    }

    public function index()
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        // Menampilkan item yang dibuat berdasarkna session creator 
        $transaksi = $this->TransaksiModel->getValidasiItem();
        if (in_array($session->get('username'), ['superadmin', 'admin'])) {
            $transaksi_user = $transaksi;
        } else {
            $transaksi_user = array_filter($transaksi, function ($t) use ($session) {
                return $t['creator'] == $session->get('username');
            });
        }

        $data = [
            'title' => 'Validasi Item',
            'username' => $session->get('username'),
            'transaksi' => $transaksi_user,
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
        ];
        return view('PoinMarket_Admin/Page/validasi_item', $data);
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
