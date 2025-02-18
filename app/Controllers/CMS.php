<?php

namespace App\Controllers;

use App\Models\PageModel;
use App\Models\JenisTransaksiModel;

class CMS extends BaseController
{
    protected $PageModel;
    protected $JenisTransaksiModel;

    public function __construct()
    {
        $this->PageModel = new PageModel();
        $this->JenisTransaksiModel = new JenisTransaksiModel();
    }

    public function index()
    {
        $session = session();

        $sideMenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
        // Ambil halaman dengan menu_position = 'topmenu' dan status = 'active'
        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

        $data = array(
            'title' => 'Content Management System',
            'username' => $session->get('username'),
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'pages' => $this->PageModel->get_all_pages(),
            'sideMenuPages' => $sideMenuPages,
            'topMenuPages' => $topMenuPages,
        );

        return view('CMS/index', $data);
    }

    // public function view($id)
    // {
    //     $sidemenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
    //     $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

    //     $data = array(
    //         'title' => 'CMS',
    //         'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
    //         'page' => $this->PageModel->get_page_by_id($id),
    //         'sidemenuPages' => $sidemenuPages,
    //         'topMenuPages' => $topMenuPages,
    //     );
    //     return view('CMS/view', $data);
    // }

    // public function create()
    // {
    //     $sidemenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
    //     $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

    //     $data = array(
    //         'title' => 'CMS',
    //         'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
    //         'sidemenuPages' => $sidemenuPages,
    //         'topMenuPages' => $topMenuPages,
    //     );
    //     return view('CMS/create', $data);
    // }

    public function store()
    {
        $this->PageModel->save([
            'title' => $this->request->getPost('title'),
            'url' => base_url($this->request->getPost('url')),
            'icon' => $this->request->getPost('icon'),
            'description' => $this->request->getPost('description'),
            'status' => 'inactive',
            'menu_position' => $this->request->getPost('menu_position') // Menyimpan posisi menu
        ]);
        return redirect()->to('/cms');
    }

    // public function edit($id)
    // {
    //     $sidemenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
    //     $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

    //     $data = array(
    //         'title' => 'CMS',
    //         'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
    //         'page' => $this->PageModel->get_page_by_id($id),
    //         'sidemenuPages' => $sidemenuPages,
    //         'topMenuPages' => $topMenuPages,
    //     );

    //     return view('CMS/edit', $data);
    // }

    public function update($id)
    {
        $this->PageModel->update($id, [
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'status' => $this->request->getPost('status'),
            'description' => $this->request->getPost('description'),
            'menu_position' => $this->request->getPost('menu_position') // Memperbarui posisi menu
        ]);
        return redirect()->to('/cms');
    }

    public function delete($id)
    {
        $this->PageModel->delete($id);
        return redirect()->to('/cms');
    }
}
