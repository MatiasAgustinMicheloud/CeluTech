<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductoModel;
use App\Models\MarcaModel;

class ProductoController extends BaseController
{
    public function index()
    {
        $model = new ProductoModel();
        $data['productos'] = $model->select('productos.*, marcas.marca_nombre')
                                   ->join('marcas', 'marcas.id_marca = productos.id_marca')
                                   ->findAll();
        $data['titulo'] = 'Productos - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/productos/index', $data);
        echo view('layouts/footer.php');
    }

    public function crear()
    {
        $marcaModel = new MarcaModel();
        $data['marcas'] = $marcaModel->where('marca_estado', 1)->findAll();
        $data['titulo'] = 'Nuevo Producto - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/productos/crear', $data);
        echo view('layouts/footer.php');
    }

    public function guardar()
    {
        $rules = [
            'producto_nombre'       => 'required|min_length[2]',
            'producto_descripcion'  => 'required|min_length[10]',
            'producto_precio'       => 'required|decimal',
            'producto_stock'        => 'required|integer',
            'id_marca'              => 'required'
        ];
        $messages = [
            'producto_nombre'      => ['required' => 'El nombre es obligatorio.', 'min_length' => 'El nombre debe tener al menos 2 caracteres.'],
            'producto_descripcion' => ['required' => 'La descripción es obligatoria.', 'min_length' => 'La descripción debe tener al menos 10 caracteres.'],
            'producto_precio'      => ['required' => 'El precio es obligatorio.', 'decimal' => 'El precio debe ser un número válido.'],
            'producto_stock'       => ['required' => 'El stock es obligatorio.', 'integer' => 'El stock debe ser un número entero.'],
            'id_marca'             => ['required' => 'La marca es obligatoria.']
        ];

        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $marcaModel = new MarcaModel();
            $data['errores'] = $this->validator->getErrors();
            $data['marcas'] = $marcaModel->where('marca_estado', 1)->findAll();
            $data['old'] = $this->request->getPost();
            $data['titulo'] = 'Nuevo Producto - CeluTech';
            echo view('layouts/header.php', $data);
            echo view('admin/productos/crear', $data);
            echo view('layouts/footer.php');
            return;
        }

        // Manejo de imagen
        $imagen = $this->request->getFile('producto_imagen');
        $nombreImagen = null;
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(FCPATH . 'images/productos/', $nombreImagen);
        }

        $model = new ProductoModel();
        $model->insert([
            'producto_nombre'      => $this->request->getPost('producto_nombre'),
            'producto_descripcion' => $this->request->getPost('producto_descripcion'),
            'producto_precio'      => $this->request->getPost('producto_precio'),
            'producto_precio_oferta' => $this->request->getPost('producto_precio_oferta') ?: null,
            'producto_stock'       => $this->request->getPost('producto_stock'),
            'producto_imagen'      => $nombreImagen,
            'id_marca'             => $this->request->getPost('id_marca'),
            'producto_estado'      => 1
        ]);

        return redirect()->to('/admin/productos');
    }

    public function editar($id)
    {
        $model = new ProductoModel();
        $marcaModel = new MarcaModel();
        $data['producto'] = $model->find($id);
        $data['marcas'] = $marcaModel->where('marca_estado', 1)->findAll();
        $data['titulo'] = 'Editar Producto - CeluTech';
        echo view('layouts/header.php', $data);
        echo view('admin/productos/editar', $data);
        echo view('layouts/footer.php');
    }

    // public function actualizar($id)
    // {
    //     $model = new ProductoModel();
    //     $producto = $model->find($id);

    //     $imagen = $this->request->getFile('producto_imagen');
    //     $nombreImagen = $producto['producto_imagen'];
    //     if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
    //         $nombreImagen = $imagen->getRandomName();
    //         $imagen->move(FCPATH . 'images/productos/', $nombreImagen);
    //     }

    //     $model->update($id, [
    //         'producto_nombre'        => $this->request->getPost('producto_nombre'),
    //         'producto_descripcion'   => $this->request->getPost('producto_descripcion'),
    //         'producto_precio'        => $this->request->getPost('producto_precio'),
    //         'producto_precio_oferta' => $this->request->getPost('producto_precio_oferta') ?: null,
    //         'producto_stock'         => $this->request->getPost('producto_stock'),
    //         'producto_imagen'        => $nombreImagen,
    //         'id_marca'               => $this->request->getPost('id_marca'),
    //         'producto_estado'        => $this->request->getPost('producto_estado')
    //     ]);

    //     return redirect()->to('/admin/productos');
    // }


    public function actualizar($id){

        $rules = [
            'producto_nombre'      => 'required|min_length[2]',
            'producto_descripcion' => 'required|min_length[10]',
            'producto_precio'      => 'required|decimal',
            'producto_stock'       => 'required|integer',
            'id_marca'             => 'required'
        ];
        $messages = [
            'producto_nombre'      => ['required' => 'El nombre es obligatorio.', 'min_length' => 'El nombre debe tener al menos 2 caracteres.'],
            'producto_descripcion' => ['required' => 'La descripción es obligatoria.', 'min_length' => 'La descripción debe tener al menos 10 caracteres.'],
            'producto_precio'      => ['required' => 'El precio es obligatorio.', 'decimal' => 'El precio debe ser un número válido.'],
            'producto_stock'       => ['required' => 'El stock es obligatorio.', 'integer' => 'El stock debe ser un número entero.'],
            'id_marca'             => ['required' => 'La marca es obligatoria.']
        ];

        if (!$this->validateData($this->request->getPost(), $rules, $messages)) {
            $marcaModel = new MarcaModel();
            $model = new ProductoModel();
            $data['errores'] = $this->validator->getErrors();
            $data['producto'] = $model->find($id);
            $data['marcas'] = $marcaModel->where('marca_estado', 1)->findAll();
            $data['titulo'] = 'Editar Producto - CeluTech';
            echo view('layouts/header.php', $data);
            echo view('admin/productos/editar', $data);
            echo view('layouts/footer.php');
            return;
        }

        $model = new ProductoModel();
        $producto = $model->find($id);

        $imagen = $this->request->getFile('producto_imagen');
        $nombreImagen = $producto['producto_imagen'];
        if ($imagen && $imagen->isValid() && !$imagen->hasMoved()) {
            $nombreImagen = $imagen->getRandomName();
            $imagen->move(FCPATH . 'images/productos/', $nombreImagen);
        }

        $model->update($id, [
            'producto_nombre'        => $this->request->getPost('producto_nombre'),
            'producto_descripcion'   => $this->request->getPost('producto_descripcion'),
            'producto_precio'        => $this->request->getPost('producto_precio'),
            'producto_precio_oferta' => $this->request->getPost('producto_precio_oferta') ?: null,
            'producto_stock'         => $this->request->getPost('producto_stock'),
            'producto_imagen'        => $nombreImagen,
            'id_marca'               => $this->request->getPost('id_marca'),
            'producto_estado'        => $this->request->getPost('producto_estado')
        ]);

        return redirect()->to('/admin/productos');
    }


    public function eliminar($id)
    {
        $model = new ProductoModel();
        $model->update($id, ['producto_estado' => 0]);
        return redirect()->to('/admin/productos');
    }
}