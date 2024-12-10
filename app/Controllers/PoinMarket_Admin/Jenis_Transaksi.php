<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\BadgesModel;
use App\Models\JenisTransaksiModel;
use App\Models\TransaksiModel;
use App\Models\DataTransaksiModel;
use App\Models\MahasiswaModel;
use CodeIgniter\HTTP\Request;



class Jenis_Transaksi extends BaseController
{
    protected $BadgesModel;
    protected $JenisTransaksiModel;
    protected $TransaksiModel;
    protected $DataTransaksiModel;
    protected $MahasiswaModel;

    public function __construct()
    {
        $this->BadgesModel = new BadgesModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
        $this->TransaksiModel = new TransaksiModel();
        $this->DataTransaksiModel = new DataTransaksiModel();
        $this->MahasiswaModel = new MahasiswaModel();
    }

    public function reward()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['101'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Rewards',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('PoinMarket_Admin/Page/jenis_transaksi', $data);
    }

    public function pembelian()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['102'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Pembelian',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('PoinMarket_Admin/Page/jenis_transaksi', $data);
    }

    public function punishment()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['103'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Punishment',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('PoinMarket_Admin/Page/jenis_transaksi', $data);
    }

    public function misi_tambah()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('transaksi');
        $jenis = ['105'];
        $builder->whereIn('kode_jenis', $jenis);

        $session = session();

        $data = [
            'title' => 'Misi Tambahan',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getJenis($jenis),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('PoinMarket_Admin/Page/jenis_transaksi', $data);
    }

    //Save jenis_transaksi
    public function save_Jenis()
    {
        if (!$this->validate([
            'nama_transaksi' => 'required|is_unique[transaksi.nama_transaksi]',
            'id_transaksi' => 'required|is_unique[transaksi.id_transaksi]'
        ])) {
            return redirect()->back()->withInput()->with("gagal", "Data Sudah Ada !");
        }

        $id_transaksi = $this->request->getVar('id_transaksi');
        $kode_jenis = $this->request->getVar('kode_jenis');
        $nama = $this->request->getVar('nama_transaksi');
        $detail = $this->request->getVar('detail');
        $keterangan = $this->request->getVar('keterangan');
        $point = $this->request->getVar('poin_digunakan');

        // Generate ID transaksi
        $nomorUrut = $this->TransaksiModel->getNextNomorUrut($kode_jenis);
        $id_transaksi = $kode_jenis . str_pad($nomorUrut, 2, '0', STR_PAD_LEFT);

        $data = [
            'id_transaksi' => $id_transaksi,
            'kode_jenis' => $kode_jenis,
            'nama_transaksi' => $nama,
            'detail' => $detail,
            'keterangan' => $keterangan,
            'poin_digunakan' => $point
        ];
        $this->TransaksiModel->save($data);

        session()->setFlashdata("sukses", "Data $nama Berhasil Ditambah.");
        return redirect()->back();
    }

    // Update jenis transaksi
    public function update_Jenis($id_transaksi)
    {
        $nama = $this->request->getPost('nama_transaksi');
        $detail = $this->request->getPost('detail');
        $keterangan = $this->request->getPost('keterangan');
        $poin_digunakan = $this->request->getPost('poin_digunakan');

        $data = [
            'nama_transaksi' => $nama,
            'detail' => $detail,
            'keterangan' => $keterangan,
            'poin_digunakan' => $poin_digunakan
        ];
        $this->TransaksiModel->update($id_transaksi, $data);

        session()->setFlashdata("sukses", "Data $nama Berhasil di Update.");
        return redirect()->back();
    }

    //Menghapus jenis transaksi dari database berdasarkan ID
    public function delete_Jenis($id_transaksi)
    {
        $this->TransaksiModel->delete($id_transaksi);

        session()->setFlashdata("sukses", "Data Berhasil Dihapus.");

        return redirect()->back();
    }
}
