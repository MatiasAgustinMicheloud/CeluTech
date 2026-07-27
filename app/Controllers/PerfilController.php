<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class PerfilController extends BaseController
{
    public function index()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $model = new UsuarioModel();
        $data['usuario'] = $model->find(session()->get('id_usuario'));
        $data['titulo'] = 'Mi Perfil - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('perfil/index', $data);
        echo view('layouts/footer.php');
    }

    public function actualizar()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $rules = [
            'usuario_nombre'   => 'required|min_length[2]',
            'usuario_apellido' => 'required|min_length[2]',
            'usuario_email'    => 'required|valid_email'
        ];
        $messages = [
            'usuario_nombre'   => ['required' => 'El nombre es obligatorio.', 'min_length' => 'Mínimo 2 caracteres.'],
            'usuario_apellido' => ['required' => 'El apellido es obligatorio.', 'min_length' => 'Mínimo 2 caracteres.'],
            'usuario_email'    => ['required' => 'El email es obligatorio.', 'valid_email' => 'El email no es válido.']
        ];

        $model = new UsuarioModel();

        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $data['errores'] = $this->validator->getErrors();
            $data['usuario'] = $model->find(session()->get('id_usuario'));
            $data['titulo'] = 'Mi Perfil - CeluTech';
            echo view('layouts/header.php', $data);
            echo view('perfil/index', $data);
            echo view('layouts/footer.php');
            return;
        }

        $updateData = [
            'usuario_nombre'   => $this->request->getPost('usuario_nombre'),
            'usuario_apellido' => $this->request->getPost('usuario_apellido'),
            'usuario_email'    => $this->request->getPost('usuario_email')
        ];

        // Solo cambia la password si la llenó
        $nueva_password = $this->request->getPost('nueva_password');
        $confirmar_password = $this->request->getPost('confirmar_password');

        if (!empty($nueva_password)) {
            if ($nueva_password !== $confirmar_password) {
                $data['errores'] = ['password' => 'Las contraseñas no coinciden.'];
                $data['usuario'] = $model->find(session()->get('id_usuario'));
                $data['titulo'] = 'Mi Perfil - CeluTech';
                echo view('layouts/header.php', $data);
                echo view('perfil/index', $data);
                echo view('layouts/footer.php');
                return;
            }
            $updateData['usuario_password'] = password_hash($nueva_password, PASSWORD_BCRYPT);
        }

        $model->update(session()->get('id_usuario'), $updateData);

        // Actualizar sesión
        session()->set('usuario_nombre', $this->request->getPost('usuario_nombre'));

        session()->setFlashdata('exito', '¡Perfil actualizado correctamente!');
        return redirect()->to('/perfil');
    }
}