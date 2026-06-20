<?php

namespace App\Models;

use CodeIgniter\Model;

Class UsuarioModel extends Model{

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowFields = [
        'usuario_nombre',
        'usuario_apellido',
        'usuario_email',
        'usuario_password',
        'id_perfil',
        'usuario_estado'
    ];

    public function obtenerPorEmail($email){
        try {
            return $this->where('usuario_email', $email)->first();
        } catch (\Exception $e) {
            return null;
        }
    }


}