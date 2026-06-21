<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

//Metodos: index - login - logout
class AuthController extends BaseController{
    
    public function index(){
        // session()->destroy();
        $data['titulo'] = 'Login - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('auth/login');
        echo view('layouts/footer.php');
    }

    public function login(){
        $data = [
            'usuario_email' => $this->request->getPost('usuario_email'),
            'usuario_password' => $this->request->getPost('usuario_password')
        ];

        $rules = [
            'usuario_email' => 'required|valid_email',
            'usuario_password' => 'required|min_length[8]'
        ];

        if(!$this -> validateData($data, $rules)) {
            return view('auth/login', [ 'errores' => $this->validator->getErrors() ]);
        }

        $model = new UsuarioModel();
        //obtener usuario por el email
        $usuario = $model-> obtenerPorEmail($data['usuario_email']);

        if(!$usuario || !password_verify($data['usuario_password'], $usuario['usuario_password'])){
            return view('auth/login', ['error' => 'Email o contraseña incorrectos']);
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



}
