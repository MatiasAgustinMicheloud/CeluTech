<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center text-uppercase mb-4">Nuevo Producto</h2>

                    <?php if(isset($errores)): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errores as $e): ?>
                                <p class="mb-0"><?= $e ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/productos/guardar') ?>" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="producto_nombre" class="form-control" value="<?= isset($old) ? $old['producto_nombre'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Marca</label>
                            <select name="id_marca" class="form-select">
                                <option value="">Seleccionar marca...</option>
                                <?php foreach($marcas as $marca): ?>
                                    <option value="<?= $marca['id_marca'] ?>" <?= isset($old) && $old['id_marca'] == $marca['id_marca'] ? 'selected' : '' ?>>
                                        <?= $marca['marca_nombre'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descripción / Características</label>
                            <textarea name="producto_descripcion" class="form-control" rows="4"><?= isset($old) ? $old['producto_descripcion'] : '' ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio</label>
                                <input type="number" step="0.01" name="producto_precio" class="form-control" value="<?= isset($old) ? $old['producto_precio'] : '' ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Precio oferta <small class="text-muted">(opcional)</small></label>
                                <input type="number" step="0.01" name="producto_precio_oferta" class="form-control" value="<?= isset($old) ? $old['producto_precio_oferta'] : '' ?>">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input type="number" name="producto_stock" class="form-control" value="<?= isset($old) ? $old['producto_stock'] : '' ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagen</label>
                            <input type="file" name="producto_imagen" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-dark w-100 text-uppercase mt-3">Guardar</button>
                    </form>

                    <a href="<?= base_url('admin/productos') ?>" class="btn btn-secondary w-100 mt-2">← Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>