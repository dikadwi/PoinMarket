<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class SwaggerController extends BaseController
{
    public function index()
    {
        return view('Swagger/index'); 
    }
}
