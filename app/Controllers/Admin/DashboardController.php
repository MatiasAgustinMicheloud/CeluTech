<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;

class DashboardController extends BaseController{

    public function index(){
        $data['titulo'] = 'Dashboard - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/dashboard');
        echo view('layouts/footer.php');
    }

    

}