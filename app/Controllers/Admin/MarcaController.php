<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MarcaModel;

class MarcaController extends BaseController{

    public function index(){
        $data['titulo'] = 'Marcas - CeluTech';
        $model = new MarcaModel();
        $data['marcas'] = $model->findAll();

        echo view('layouts/header.php', $data);
        echo view('admin/marcas/index', $data);
        echo view('layouts/footer.php');
    }

    public function crear(){
        $data['titulo'] = 'Nueva Marca - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/marcas/crear', $data);
        echo view('layouts/footer.php');
    }

    public function guardar(){
        $rules = [
            'marca_nombre' => 'required|min_length[2]|is_unique[marcas.marca_nombre]'
        ];
        $messages = [
            'marca_nombre' => [
                'required' => 'El campo nombre esta vacío',
                'min_length' => 'El nombre debe tener al menos 2 caracteres',
                'is_unique' => 'La marca ya existe'
            ]
        ];

        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $data['errores'] = $this->validator->getErrors();
            $data['titulo'] = 'Nueva Marca - CeluTech';
            $data['old'] = $this->request->getPost();

            echo view('layouts/header.php', $data);
            echo view('admin/marcas/crear', $data);
            echo view('layouts/footer.php');
            return;
        }

        $model = new MarcaModel();
        $model->insert([
            'marca_nombre' => $this->request->getPost('marca_nombre'),
            'marca_estado' => 1
        ]);

        return redirect()->to('/admin/marcas');
    }


    public function editar($id){
        $model = new MarcaModel();
        $data['marca'] = $model->find($id);
        $data['titulo'] = 'Editar Marca - CeluTech';

        echo view('layouts/header.php', $data);
        echo view('admin/marcas/editar', $data);
        echo view('layouts/footer.php');

    }

    public function actualizar($id){
        $model = new MarcaModel();
        $rules = [
            'marca_nombre' => 'required|min_length[2]'
        ];
        $messages = [
            'marca_nombre' => [
                'required'   => 'El nombre de la marca es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 2 caracteres.'
            ]
        ];

        if(!$this->validateData($this->request->getPost(), $rules, $messages)){
            $data['errores'] = $this->validator->getErrors();
            $data['titulo'] = 'Editar Marca - CeluTech';
            $data['marca'] = $model->find($id);

            echo view('layouts/header.php', $data);
            echo view('admin/marcas/editar', $data);
            echo view('layouts/footer.php');
            return;
        }

        $model->update($id, [
            'marca_nombre' => $this->request->getPost('marca_nombre'),
            'marca_estado' => $this->request->getPost('marca_estado')
        ]);

        return redirect()->to('/admin/marcas');
    }


    public function eliminar($id){
        $model = new MarcaModel();
        
        $model->update($id, ['marca_estado' => 0]);

        return redirect()->to('/admin/marcas');

    }

}
































