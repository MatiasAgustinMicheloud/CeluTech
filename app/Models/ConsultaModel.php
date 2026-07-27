<?php

namespace App\Models;

use CodeIgniter\Model;

class ConsultaModel extends Model
{
    protected $table = 'consultas';
    protected $primaryKey = 'id_consulta';
    protected $allowedFields = [
        'nombre',
        'email',
        'motivo',
        'consulta',
        'estado',
        'id_usuario'
    ];
}