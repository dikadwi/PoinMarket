<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM badssges");
        $results = $query->getResult();
        print_r($results);
    }
}
