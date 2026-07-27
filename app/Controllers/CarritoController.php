<?php

namespace App\Controllers;

use App\Models\ProductoModel;


Class CarritoController extends BaseController{

    public function agregar(){

        $id_producto = $this->request->getPost('id_producto');
        $cantidad = (int)$this->request->getPost('cantidad');

        $model = new ProductoModel();
        $producto = $model->find($id_producto);

        if (!$producto) {
            return redirect()->to('/catalogo');
        }

        $carrito = session()->get('carrito') ?? [];

        // Verificar stock
        $cantidad_en_carrito = isset($carrito[$id_producto]) ? $carrito[$id_producto]['cantidad'] : 0;
        $cantidad_total = $cantidad_en_carrito + $cantidad;

        if ($cantidad_total > $producto['producto_stock']) {
            // Redirigir con mensaje de error
            session()->setFlashdata('error', 'No hay suficiente stock disponible.');
            return redirect()->to('/catalogo/' . $id_producto);
        }

        $id_producto = $this->request->getPost('id_producto');
        $cantidad = $this->request->getPost('cantidad');

        $model = new ProductoModel();
        $producto = $model->find($id_producto);

        if (!$producto) {
            return redirect()->to('/catalogo');
        }

        $carrito = session()->get('carrito') ?? [];

        if (isset($carrito[$id_producto])) {
            $carrito[$id_producto]['cantidad'] += $cantidad;
        } else {
            $carrito[$id_producto] = [
                'id_producto' => $producto['id_producto'],
                'producto_nombre' => $producto['producto_nombre'],
                'producto_precio' => $producto['producto_precio_oferta'] ?? $producto['producto_precio'],
                'producto_imagen' => $producto['producto_imagen'],
                'cantidad' => $cantidad
            ];
        }

        session()->set('carrito', $carrito);
        return redirect()->to('/carrito');

    }


    public function index(){

        $carrito = session()->get('carrito') ?? [];
        $total = 0;

        foreach ($carrito as $item) {
            $total += $item['producto_precio'] * $item['cantidad'];
        }

        $data['titulo'] = 'Carrito - CeluTech';
        $data['carrito'] = $carrito;
        $data['total'] = $total;

        echo view('layouts/header.php', $data);
        echo view('carrito/index', $data);
        echo view('layouts/footer.php');

    }


    public function eliminar($id_producto){

        $carrito = session()->get('carrito') ?? [];

        unset($carrito[$id_producto]);

        session()->set('carrito', $carrito);

        return redirect()->to('/carrito');

    }


    public function vaciar(){

        session()->remove('carrito');
        return redirect()->to('/carrito');

    }


}