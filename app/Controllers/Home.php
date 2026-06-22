<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data['titulo'] = 'CeluTech';
        echo view('layouts/header.php', $data);
        echo view('home');
        echo view('layouts/footer.php');
    }
}
