<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

//Metodos: index - login - logout
class AuthController extends BaseController{
    
    public function login(){
        // session()->destroy();
        $data['titulo'] = 'Login - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('auth/login');
        echo view('layouts/footer.php');
    }

    public function loginProcesar(){
        $data = [
            'usuario_email' => $this->request->getPost('usuario_email'),
            'usuario_password' => $this->request->getPost('usuario_password')
        ];

        $rules = [
            'usuario_email' => 'required|valid_email',
            'usuario_password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z]).+$/]'
        ];

        $messages = [
            'usuario_email' => [
                'required' => 'El campo email esta vacío',
                'valid_email' => 'El email no es valido'
            ],
            'usuario_password' => [
                'required' => 'El campo contaseña esta vacío',
                'min_length' => 'La contraseña debe tener al menos 8 caracteres',
                'regex_match' => 'La contraseña debe tener al menos una mayúscula y una minúscula.'

            ]
        ];

        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $data['errores'] = $this->validator->getErrors();
            $data['titulo'] = 'Login - CeluTech';
            $data['old'] = $this->request->getPost();
            echo view('layouts/header.php', $data);
            echo view('auth/login', $data);
            echo view('layouts/footer.php');
            return;
        }

        $model = new UsuarioModel();
        //obtener usuario por el email
        $usuario = $model-> obtenerPorEmail($data['usuario_email']);

        if(!$usuario || !password_verify($data['usuario_password'], $usuario['usuario_password'])){
            $data['error'] = 'Email o contraseña incorrectos.';
            $data['titulo'] = 'Login - CeluTech';
            $data['old'] = $this->request->getPost();
            echo view('layouts/header.php', $data);
            echo view('auth/login', $data);
            echo view('layouts/footer.php');
            return;
        }

        //Guardar sesion
        session()->set([
            'id_usuario' => $usuario['id_usuario'],
            'usuario_nombre' => $usuario['usuario_nombre'],
            'id_perfil' => $usuario['id_perfil'],
            'logueado' => true
        ]);

        //redirigir segun rol
        if($usuario['id_perfil'] == 1){
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->to('/catalogo');
    }


    public function logout(){
        session()->destroy();
        return redirect()->to('/login');
    }


    public function registro(){
        $data['titulo'] = 'Registro - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('auth/registro');
        echo view('layouts/footer.php');
    }

    public function registrar(){
        $rules = [
            'usuario_nombre' => 'required|min_length[2]',
            'usuario_apellido' => 'required|min_length[2]',
            'usuario_email' => 'required|valid_email|is_unique[usuarios.usuario_email]',
            'usuario_password' => 'required|min_length[8]|regex_match[/^(?=.*[a-z])(?=.*[A-Z]).+$/]'
        ];

        $messages = [
            'usuario_nombre'   => [
                'required'   => 'El nombre es obligatorio.',
                'min_length' => 'El nombre debe tener al menos 2 caracteres.'
            ],
            'usuario_apellido' => [
                'required'   => 'El apellido es obligatorio.',
                'min_length' => 'El apellido debe tener al menos 2 caracteres.'
            ],
            'usuario_email'    => [
                'required'    => 'El email es obligatorio.',
                'valid_email' => 'El email no es válido.',
                'is_unique'   => 'Ese email ya está registrado.'
            ],
            'usuario_password' => [
                'required'     => 'La contraseña es obligatoria.',
                'min_length'   => 'La contraseña debe tener al menos 8 caracteres.',
                'regex_match'  => 'La contraseña debe tener al menos una mayúscula y una minúscula.'
            ]
        ];


        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $data['errores'] = $this->validator->getErrors();
            $data['old'] = $this->request->getPost();
            $data['titulo'] = 'Registro - CeluTech';
            echo view('layouts/header.php', $data);
            echo view('auth/registro', $data);
            echo view('layouts/footer.php');
            return;
        }

        $model = new UsuarioModel();
        $model-> insert([
            'usuario_nombre' => $this->request->getPost('usuario_nombre'),
            'usuario_apellido' => $this->request->getPost('usuario_apellido'),
            'usuario_email' => $this->request->getPost('usuario_email'),
            'usuario_password' => password_hash($this->request->getPost('usuario_password'), PASSWORD_BCRYPT),
            'id_perfil' => 2,
            'usuario_estado' => 1
        ]);

        return redirect()->to('/login');
    }


}
