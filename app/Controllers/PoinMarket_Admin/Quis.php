<?php

namespace App\Controllers\PoinMarket_Admin;

use App\Models\QuisModel;
use App\Models\PageModel;

class Quis extends BaseController
{
    protected $QuisModel;
    protected $PageModel;

    public function __construct()
    {
        $this->QuisModel = new QuisModel();
        $this->PageModel = new PageModel();
    }

    // Menampilkan daftar pertanyaan
    public function index()
    {
        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();
        $data = [
            'title' => 'Quis',
            'topMenuPages' => $topMenuPages,
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
                'kategori' => $this->request->getPost('kategori'),
            ];

            $this->QuisModel->insert($data); // Simpan data ke database
            return redirect()->back()->with('sukses', 'Pertanyaan berhasil ditambahkan.');
        } else {
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
                'kategori' => $this->request->getPost('kategori'),
            ];

            $this->QuisModel->update($id, $data); // Update data ke database
            return redirect()->back()->with('sukses', 'Pertanyaan berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    }

    // Menghap us pertanyaan dari database
    public function hapus($id)
    {
        $this->QuisModel->delete($id); // Hapus data dari database
        return redirect()->back()->with('sukses', 'Pertanyaan berhasil dihapus.');
    }
}
