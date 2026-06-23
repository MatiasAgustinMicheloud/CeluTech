<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center text-uppercase mb-4">Editar Producto</h2>

                    <?php if(isset($errores)): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errores as $e): ?>
                                <p class="mb-0"><?= $e ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/productos/actualizar/' . $producto['id_producto']) ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="producto_nombre" class="form-control" value="<?= $producto['producto_nombre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Marca</label>
                            <select name="id_marca" class="form-select">
                                <?php foreach($marcas as $marca): ?>
                                    <option value="<?= $marca['id_marca'] ?>" <?= $producto['id_marca'] == $marca['id_marca'] ? 'selected' : '' ?>>
                                        <?= $marca['marca_nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción / Características</label>
                            <textarea name="producto_descripcion" class="form-control" rows="4"><?= $producto['producto_descripcion'] ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" step="0.01" name="producto_precio" class="form-control" value="<?= $producto['producto_precio'] ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio oferta <small class="text-muted">(opcional)</small></label>
                                <input type="number" step="0.01" name="producto_precio_oferta" class="form-control" value="<?= $producto['producto_precio_oferta'] ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="producto_stock" class="form-control" value="<?= $producto['producto_stock'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagen actual</label><br>
                            <?php if($producto['producto_imagen']): ?>
                                <img src="<?= base_url('images/productos/' . $producto['producto_imagen']) ?>" width="100" class="mb-2">
                            <?php else: ?>
                                <p class="text-muted">Sin imagen</p>
                            <?php endif; ?>
                            <label class="form-label mt-2">Cambiar imagen <small class="text-muted">(opcional)</small></label>
                            <input type="file" name="producto_imagen" class="form-control" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="producto_estado" class="form-select">
                                <option value="1" <?= $producto['producto_estado'] == 1 ? 'selected' : '' ?>>Activo</option>
                                <option value="0" <?= $producto['producto_estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 text-uppercase mt-3">Actualizar</button>
                    </form>

                    <a href="<?= base_url('admin/productos') ?>" class="btn btn-secondary w-100 mt-2">← Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>