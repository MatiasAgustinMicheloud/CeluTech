<?php

namespace App\Controllers;

use App\Models\VentaModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductoModel;
use App\Models\FacturaModel;

Class CheckoutController extends BaseController{

    public function index(){
        
        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $carrito = session()->get('carrito') ?? [];

        if (empty($carrito)) {
            return redirect()->to('/carrito');
        }

        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['producto_precio'] * $item['cantidad'];
        }

        $data['carrito'] = $carrito;
        $data['total'] = $total;
        $data['titulo'] = 'Confirmar compra - CeluTech';

        echo view('layouts/header.php', $data);
        echo view('checkout/index', $data);
        echo view('layouts/footer.php');
    }
    

    public function confirmar(){

        if (!session()->get('logueado')) {
            return redirect()->to('/login');
        }

        $carrito = session()->get('carrito') ?? [];

        if (empty($carrito)) {
            return redirect()->to('/carrito');
        }

        $rules = [
            'metodo_envio' => 'required',
            'metodo_pago'  => 'required',
        ];
        $messages = [
            'metodo_envio' => ['required' => 'Seleccioná un método de envío.'],
            'metodo_pago'  => ['required' => 'Seleccioná un método de pago.'],
        ];

        if ($this->request->getPost('metodo_envio') == 'domicilio') {
            $rules['direccion'] = 'required|min_length[5]';
            $messages['direccion'] = [
                'required'   => 'Ingresá una dirección de envío.',
                'min_length' => 'La dirección debe tener al menos 5 caracteres.'
            ];
        }

        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $total = 0;
            foreach ($carrito as $item) {
                $total += $item['producto_precio'] * $item['cantidad'];
            }
            $data['errores'] = $this->validator->getErrors();
            $data['carrito'] = $carrito;
            $data['total'] = $total;
            $data['titulo'] = 'Confirmar compra - CeluTech';
            echo view('layouts/header.php', $data);
            echo view('checkout/index', $data);
            echo view('layouts/footer.php');
            return;
        }

        $id_usuario = session()->get('id_usuario');
        $total = 0;
        foreach ($carrito as $item) {
            $total += $item['producto_precio'] * $item['cantidad'];
        }

        // Crear venta
        $ventaModel = new VentaModel();
        $id_venta = $ventaModel->insert([
            'id_usuario'   => $id_usuario,
            'total'        => $total,
            'venta_estado' => 1
        ], true);

        // Crear detalles y actualizar stock
        $detalleModel = new DetalleVentaModel();
        $productoModel = new ProductoModel();

        foreach ($carrito as $item) {
            $detalleModel->insert([
                'id_venta'        => $id_venta,
                'id_producto'     => $item['id_producto'],
                'cantidad'        => $item['cantidad'],
                'precio_unitario' => $item['producto_precio']
            ]);

            $producto = $productoModel->find($item['id_producto']);
            $productoModel->update($item['id_producto'], [
                'producto_stock' => $producto['producto_stock'] - $item['cantidad']
            ]);
        }

        // Crear factura
        $facturaModel = new FacturaModel();
        $id_factura = $facturaModel->insert([
            'id_venta' => $id_venta,
            'total'    => $total
        ], true);

        // Guardar datos de envío en sesión para mostrar en factura
        session()->setFlashdata('metodo_envio', $this->request->getPost('metodo_envio'));
        session()->setFlashdata('metodo_pago', $this->request->getPost('metodo_pago'));
        session()->setFlashdata('direccion', $this->request->getPost('direccion'));

        // Vaciar carrito
        session()->remove('carrito');

        return redirect()->to('/factura/' . $id_factura);
    }


    public function factura($id_factura){
        $facturaModel = new FacturaModel();
        $ventaModel = new VentaModel();
        $detalleModel = new DetalleVentaModel();

        $factura = $facturaModel->find($id_factura);
        $venta = $ventaModel->find($factura['id_venta']);
        
        $detalles = $detalleModel
            ->select('detalle_ventas.*, productos.producto_nombre')
            ->join('productos', 'productos.id_producto = detalle_ventas.id_producto')
            ->where('id_venta', $factura['id_venta'])
            ->findAll();

        $data['factura'] = $factura;
        $data['venta'] = $venta;
        $data['detalles'] = $detalles;
        $data['titulo'] = 'Factura #' . $id_factura . ' - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('checkout/factura', $data);
        echo view('layouts/footer.php');
    }

}