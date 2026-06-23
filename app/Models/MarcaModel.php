<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcaModel extends model{
    protected $table = 'marcas';
    protected $primaryKey = 'id_marca';
    protected $allowedFields = [
        'marca_nombre',
        'marca_estado'
    ];
    
}