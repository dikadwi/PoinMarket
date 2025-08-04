<?php

namespace App\Controllers;

class Panduan extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Panduan Penggunaan PoinMarket',
            'page' => 'panduan'
        ];
        return view('panduan/index', $data);
    }
}
