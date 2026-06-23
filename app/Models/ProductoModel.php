<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoModel extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = [
        'producto_nombre',
        'producto_descripcion',
        'producto_precio',
        'producto_precio_oferta',
        'producto_stock',
        'producto_imagen',
        'id_marca',
        'producto_estado'
    ];
}