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

    public function all()
    {
        $session = session();

        $data = [
            'title' => 'Jenis Transaksi',
            'username' => $session->get('username'),
            'transaksi' => $this->TransaksiModel->getTransaksi(),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),

        ];
        return view('PoinMarket_Admin/Page/jenis_transaksi_all', $data);
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

    public function save_Jenis()
    {
        if (!$this->validate([
            'nama_transaksi' => 'required',
            'kode_jenis' => 'required',
            'poin_digunakan' => 'required'
        ])) {
            return redirect()->back()->withInput()->with("gagal", "Validasi gagal. Mohon cek inputan Anda!");
        }

        // Mengambil Kode Jenis
        $kode_jenis = $this->request->getVar('kode_jenis');

        // Mengambil id_transaksi terakhir
        $lastTransaction = $this->TransaksiModel->where('kode_jenis', $kode_jenis)
            ->orderBy('id_transaksi', 'DESC')
            ->first();
        $lastId = $lastTransaction ? (int)substr($lastTransaction['id_transaksi'], strlen($kode_jenis)) : 0;

        // Membuat id_transaksi baru dengan +1 dari id_transaksi terakhir
        $newId = $lastId + 1;
        $id_transaksi = $kode_jenis . str_pad($newId, 2, '0', STR_PAD_LEFT);

        // Menyimpan data ke database
        $data = [
            'id_transaksi' => $id_transaksi,
            'kode_jenis' => $kode_jenis,
            'nama_transaksi' => $this->request->getVar('nama_transaksi'),
            'detail' => $this->request->getVar('detail'),
            'keterangan' => $this->request->getVar('keterangan'),
            'poin_digunakan' => $this->request->getVar('poin_digunakan')
        ];

        // Melakukan insert ke database dengan penanganan kesalahan
        try {
            $this->TransaksiModel->insert($data);
            session()->setFlashdata("sukses", "Data {$this->request->getVar('nama_transaksi')} Berhasil Disimpan Dengan ID : {$id_transaksi}.");
        } catch (\Exception $e) {
            log_message('error', 'Gagal menyimpan data: ' . $e->getMessage());
            session()->setFlashdata("gagal", "Gagal menyimpan data. Silakan coba lagi.");
        }
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
        // Ambil data transaksi berdasarkan ID untuk mendapatkan nama atau informasi lainnya
        $transaksi = $this->TransaksiModel->find($id_transaksi);

        $this->TransaksiModel->delete($id_transaksi);

        session()->setFlashdata("sukses", "Data " . $transaksi['nama_transaksi'] . " Berhasil Dihapus.");

        return redirect()->back();
    }
}
