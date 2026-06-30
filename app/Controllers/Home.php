<?php

namespace App\Controllers;

use App\Models\ProductoModel;

class Home extends BaseController
{
    public function index()
    {
        $productoModel = new ProductoModel();
        $data['productos_destacados'] = $productoModel
            ->select('productos.*, marcas.marca_nombre')
            ->join('marcas', 'marcas.id_marca = productos.id_marca')
            ->where('producto_estado', 1)
            ->orderBy('id_producto', 'DESC')
            ->limit(6)
            ->findAll();

        $data['titulo'] = 'CeluTech';
        echo view('layouts/header.php', $data);
        echo view('home');
        echo view('layouts/footer.php');
    }
}