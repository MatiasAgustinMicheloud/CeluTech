<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\VentaModel;
use App\Models\DetalleVentaModel;

class VentaController extends BaseController
{
    public function index()
    {
        $ventaModel = new VentaModel();
        $data['ventas'] = $ventaModel
            ->select('ventas.*, usuarios.usuario_nombre, usuarios.usuario_apellido')
            ->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario')
            ->orderBy('venta_fecha', 'DESC')
            ->findAll();

        $data['titulo'] = 'Ventas - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/ventas/index', $data);
        echo view('layouts/footer.php');
    }

    public function detalle($id_venta)
    {
        $ventaModel = new VentaModel();
        $detalleModel = new DetalleVentaModel();

        $data['venta'] = $ventaModel
            ->select('ventas.*, usuarios.usuario_nombre, usuarios.usuario_apellido, usuarios.usuario_email')
            ->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario')
            ->where('ventas.id_venta', $id_venta)
            ->first();

        $data['detalles'] = $detalleModel
            ->select('detalle_ventas.*, productos.producto_nombre')
            ->join('productos', 'productos.id_producto = detalle_ventas.id_producto')
            ->where('id_venta', $id_venta)
            ->findAll();

        $data['titulo'] = 'Detalle de Venta - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/ventas/detalle', $data);
        echo view('layouts/footer.php');
    }
}