<?php

namespace App\Controllers;

use App\Models\ProductoModel;
use App\Models\MarcaModel;

class CatalogoController extends BaseController
{
    public function index(){
        $productoModel = new ProductoModel();
        $marcaModel = new MarcaModel();

        $marca = $this->request->getGet('marca');
        $oferta = $this->request->getGet('oferta');

        $query = $productoModel
            ->select('productos.*, marcas.marca_nombre')
            ->join('marcas', 'marcas.id_marca = productos.id_marca')
            ->where('producto_estado', 1);

        if ($marca) {
            $query->where('productos.id_marca', $marca);
        }

        if ($oferta) {
            $query->where('producto_precio_oferta IS NOT NULL');
        }

        $data['productos'] = $query->findAll();
        $data['marcas'] = $marcaModel->where('marca_estado', 1)->findAll();
        $data['marca_activa'] = $marca;
        $data['oferta_activa'] = $oferta;
        $data['titulo'] = 'Catálogo - CeluTech';

        echo view('layouts/header.php', $data);
        echo view('catalogo/index', $data);
        echo view('layouts/footer.php');
    }

    public function detalle($id)
    {
        $productoModel = new ProductoModel();
        $data['producto'] = $productoModel
            ->select('productos.*, marcas.marca_nombre')
            ->join('marcas', 'marcas.id_marca = productos.id_marca')
            ->where('id_producto', $id)
            ->first();

        $data['titulo'] = $data['producto']['producto_nombre'] . ' - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('catalogo/detalle', $data);
        echo view('layouts/footer.php');
    }
}