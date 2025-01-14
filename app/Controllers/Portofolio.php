<?php

namespace App\Controllers;


class Portofolio extends BaseController
{


    public function index()
    {
        $data = array(
            'title' => 'Portofolio',
        );
        return view('Portofolio/index', $data);
    }
}
