<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\FacturaModel;

class HistorialController extends BaseController
{
    public function index()
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $id_usuario = session()->get('id_usuario');
        $ventaModel = new VentaModel();

        $data['ventas'] = $ventaModel
            ->where('id_usuario', $id_usuario)
            ->orderBy('venta_fecha', 'DESC')
            ->findAll();

        $data['titulo'] = 'Mis Compras - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('historial/index', $data);
        echo view('layouts/footer.php');
    }

    public function detalle($id_venta)
    {
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $ventaModel = new VentaModel();
        $detalleModel = new DetalleVentaModel();
        $facturaModel = new FacturaModel();

        $venta = $ventaModel->find($id_venta);

        // Seguridad: verificar que la venta sea del usuario logueado
        if ($venta['id_usuario'] != session()->get('id_usuario')) {
            return redirect()->to('/historial');
        }

        $data['venta'] = $venta;
        $data['factura'] = $facturaModel->where('id_venta', $id_venta)->first();
        $data['detalles'] = $detalleModel
            ->select('detalle_ventas.*, productos.producto_nombre')
            ->join('productos', 'productos.id_producto = detalle_ventas.id_producto')
            ->where('id_venta', $id_venta)
            ->findAll();

        $data['titulo'] = 'Detalle de compra - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('historial/detalle', $data);
        echo view('layouts/footer.php');
    }
}