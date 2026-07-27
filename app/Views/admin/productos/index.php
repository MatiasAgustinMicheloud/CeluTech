<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-uppercase">Productos</h2>
        <a href="<?= base_url('admin/productos/crear') ?>" class="btn btn-dark">+ Nuevo Producto</a>
    </div>

    <form method="GET" action="<?= base_url('admin/productos') ?>" class="row g-3 mb-4">
        <div class="col-md-8">
            <input type="text" name="busqueda" class="form-control" 
                placeholder="Buscar por nombre o marca..." 
                value="<?= $busqueda ?? '' ?>">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-dark">Buscar</button>
            <a href="<?= base_url('admin/productos') ?>" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Marca</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $producto): ?>
            <tr>
                <td><?= $producto['id_producto'] ?></td>
                <td><?= $producto['producto_nombre'] ?></td>
                <td><?= $producto['marca_nombre'] ?></td>
                <td>$<?= number_format($producto['producto_precio'], 2) ?></td>
                <td><?= $producto['producto_stock'] ?></td>
                <td>
                    <?php if($producto['producto_estado'] == 1): ?>
                        <span class="badge bg-success">Activo</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Inactivo</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('admin/productos/editar/' . $producto['id_producto']) ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="<?= base_url('admin/productos/eliminar/' . $producto['id_producto']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Desactivar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary mt-3">← Volver al panel</a>
</div>