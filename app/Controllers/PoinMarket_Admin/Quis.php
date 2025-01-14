<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\QuisModel;
use App\Models\PageModel;
use App\Models\KategoriQuisModel;

class Quis extends BaseController
{
    protected $QuisModel;
    protected $PageModel;
    protected $KategoriQuisModel;

    public function __construct()
    {
        $this->QuisModel = new QuisModel();
        $this->PageModel = new PageModel();
        $this->KategoriQuisModel = new KategoriQuisModel();
    }

    // Menampilkan daftar pertanyaan
    public function index()
    {
        $session = session();

        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();

        $data = [
            'title' => 'Quis',
            'username' => $session->get('username'),
            'topMenuPages' => $topMenuPages,
            'sideMenuPages' => $sideMenuPages,
            'quis' => $this->QuisModel->findAll(), // Ambil semua data kuis dari database
        ];

        return view('PoinMarket_Admin/Page/quis', $data);
    }

    // Menyimpan pertanyaan baru ke database
    public function simpanPertanyaan()
    {
        $rules = [
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required',
            'poin' => 'required|numeric',
            'kategori' => 'required',
        ];

        if ($this->validate($rules)) {
            $data = [
                'pertanyaan' => $this->request->getPost('pertanyaan'),
                'opsi_a' => $this->request->getPost('opsi_a'),
                'opsi_b' => $this->request->getPost('opsi_b'),
                'opsi_c' => $this->request->getPost('opsi_c'),
                'opsi_d' => $this->request->getPost('opsi_d'),
                'jawaban_benar' => $this->request->getPost('jawaban_benar'),
                'poin' => $this->request->getPost('poin'),
                'kategori' => implode(', ', $this->request->getPost('kategori')), // Simpan kategori sebagai string yang dipisahkan koma
            ];
            // // Simpan data quis ke database
            // $this->QuisModel->insert($data);

            // Simpan data quis ke database
            $quisId = $this->QuisModel->insert($data);

            // Ambil kategori yang dipilih (array)
            $kategoriDipilih = $this->request->getPost('kategori');

            // Simpan relasi kategori ke tabel relasi (jika ada)
            if (!empty($kategoriDipilih)) {
                foreach ($kategoriDipilih as $kategori) {
                    $dataKategori = [
                        'quis_id' => $quisId, // ID quis yang baru disimpan
                        'kategori' => $kategori, // Nama kategori yang dipilih
                    ];
                    $this->KategoriQuisModel->insert($dataKategori); // Simpan ke tabel relasi
                }
            }
            // Berhasil
            return redirect()->back()->with('sukses', 'Pertanyaan berhasil ditambahkan.');
        } else {
            // Gagal
            return redirect()->back()->withInput()->with('gagal', $this->validator->getErrors());
        }
    }

    // Menyimpan perubahan pertanyaan ke database
    public function updateQuis($id)
    {
        $rules = [
            'pertanyaan' => 'required',
            'opsi_a' => 'required',
            'opsi_b' => 'required',
            'opsi_c' => 'required',
            'opsi_d' => 'required',
            'jawaban_benar' => 'required',
            'poin' => 'required|numeric',
            'kategori' => 'required',
        ];

        if ($this->validate($rules)) {
            $data = [
                'pertanyaan' => $this->request->getPost('pertanyaan'),
                'opsi_a' => $this->request->getPost('opsi_a'),
                'opsi_b' => $this->request->getPost('opsi_b'),
                'opsi_c' => $this->request->getPost('opsi_c'),
                'opsi_d' => $this->request->getPost('opsi_d'),
                'jawaban_benar' => $this->request->getPost('jawaban_benar'),
                'poin' => $this->request->getPost('poin'),
                'kategori' => implode(', ', $this->request->getPost('kategori')), // Simpan kategori sebagai string yang dipisahkan koma
            ];

            // Update ke Database
            $this->QuisModel->update($id, $data);

            return redirect()->back()->with('sukses', 'Pertanyaan berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Menghapus pertanyaan dari database
    public function hapus($id)
    {
        $this->QuisModel->delete($id); // Hapus data dari database
        return redirect()->back()->with('sukses', 'Pertanyaan berhasil dihapus.');
    }
}
