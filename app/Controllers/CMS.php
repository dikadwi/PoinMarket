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
        $sidemenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

        $data = array(
            'title' => 'Content Management System',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'pages' => $this->PageModel->get_all_pages(),
            'sidemenuPages' => $sidemenuPages,
            'topMenuPages' => $topMenuPages,
        );

        return view('CMS/list', $data);
    }

    public function view($id)
    {
        $sidemenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

        $data = array(
            'title' => 'View',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'page' => $this->PageModel->get_page_by_id($id),
            'sidemenuPages' => $sidemenuPages,
            'topMenuPages' => $topMenuPages,
        );
        return view('CMS/view', $data);
    }

    public function create()
    {
        $sidemenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

        $data = array(
            'title' => 'View',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'sidemenuPages' => $sidemenuPages,
            'topMenuPages' => $topMenuPages,
        );
        return view('CMS/create', $data);
    }

    public function store()
    {
        $this->PageModel->save([
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'description' => $this->request->getPost('description'),
            'status' => 'active',
            'menu_position' => $this->request->getPost('menu_position') // Menyimpan posisi menu
        ]);
        return redirect()->to('/cms');
    }

    public function edit($id)
    {
        $sidemenuPages = $this->PageModel->where('menu_position', 'sidemenu')->findAll();
        $topMenuPages = $this->PageModel->where('menu_position', 'topmenu')->findAll();

        $data = array(
            'title' => 'View',
            'jenis_transaksi' => $this->JenisTransaksiModel->getJenis(),
            'page' => $this->PageModel->get_page_by_id($id),
            'sidemenuPages' => $sidemenuPages,
            'topMenuPages' => $topMenuPages,
        );

        return view('CMS/edit', $data);
    }

    public function update($id)
    {
        $this->PageModel->update($id, [
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
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
