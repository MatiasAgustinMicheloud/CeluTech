<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ConsultaModel;

class ConsultaController extends BaseController
{
    public function index()
    {
        $model = new ConsultaModel();
        $data['consultas'] = $model->orderBy('estado', 'ASC')->orderBy('id_consulta', 'DESC')->findAll();
        $data['titulo'] = 'Consultas - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/consultas/index', $data);
        echo view('layouts/footer.php');
    }

    public function marcarLeido($id)
    {
        $model = new ConsultaModel();
        $model->update($id, ['estado' => 1]);
        return redirect()->to('/admin/consultas');
    }
}