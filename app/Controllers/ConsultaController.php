<?php

namespace App\Controllers;

use App\Models\ConsultaModel;

class ConsultaController extends BaseController
{
    public function index()
    {
        $data['titulo'] = 'Contacto - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('consultas/index');
        echo view('layouts/footer.php');
    }

    public function enviar()
    {
        $rules = [
            'nombre'   => 'required|min_length[2]',
            'email'    => 'required|valid_email',
            'motivo'   => 'required',
            'consulta' => 'required|min_length[10]'
        ];
        $messages = [
            'nombre'   => ['required' => 'El nombre es obligatorio.', 'min_length' => 'El nombre debe tener al menos 2 caracteres.'],
            'email'    => ['required' => 'El email es obligatorio.', 'valid_email' => 'El email no es válido.'],
            'motivo'   => ['required' => 'El motivo es obligatorio.'],
            'consulta' => ['required' => 'La consulta es obligatoria.', 'min_length' => 'La consulta debe tener al menos 10 caracteres.']
        ];

        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $data['errores'] = $this->validator->getErrors();
            $data['old'] = $this->request->getPost();
            $data['titulo'] = 'Contacto - CeluTech';
            echo view('layouts/header.php', $data);
            echo view('consultas/index', $data);
            echo view('layouts/footer.php');
            return;
        }

        $model = new ConsultaModel();
        $model->insert([
            'nombre'     => $this->request->getPost('nombre'),
            'email'      => $this->request->getPost('email'),
            'motivo'     => $this->request->getPost('motivo'),
            'consulta'   => $this->request->getPost('consulta'),
            'estado'     => 0,
            'id_usuario' => session()->get('id_usuario') ?? null
        ]);

        session()->setFlashdata('exito', '¡Tu consulta fue enviada correctamente!');
        return redirect()->to('/contacto');
    }
}