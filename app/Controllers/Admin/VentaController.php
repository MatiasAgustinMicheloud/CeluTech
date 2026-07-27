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
        
        $fecha_desde = $this->request->getGet('fecha_desde');
        $fecha_hasta = $this->request->getGet('fecha_hasta');

        $query = $ventaModel
            ->select('ventas.*, usuarios.usuario_nombre, usuarios.usuario_apellido')
            ->join('usuarios', 'usuarios.id_usuario = ventas.id_usuario')
            ->orderBy('venta_fecha', 'DESC');

        if ($fecha_desde) {
            $query->where('venta_fecha >=', $fecha_desde . ' 00:00:00');
        }
        if ($fecha_hasta) {
            $query->where('venta_fecha <=', $fecha_hasta . ' 23:59:59');
        }

        $data['ventas'] = $query->findAll();
        $data['fecha_desde'] = $fecha_desde;
        $data['fecha_hasta'] = $fecha_hasta;
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