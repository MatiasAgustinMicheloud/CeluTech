<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body p-5">
                    <h2 class="text-center text-uppercase mb-4">Editar Marca</h2>

                    <?php if(isset($errores)): ?>
                        <div class="alert alert-danger">
                            <?php foreach($errores as $e): ?>
                                <p class="mb-0"><?= $e ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('admin/marcas/actualizar/' . $marca['id_marca']) ?>" method="POST">
                        <?= csrf_field() ?>
                        <div class="mb-3">
                            <label class="form-label">Nombre de la marca</label>
                            <input type="text" name="marca_nombre" class="form-control" value="<?= $marca['marca_nombre'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Estado</label>
                            <select name="marca_estado" class="form-select">
                                <option value="1" <?= $marca['marca_estado'] == 1 ? 'selected' : '' ?>>Activo</option>
                                <option value="0" <?= $marca['marca_estado'] == 0 ? 'selected' : '' ?>>Inactivo</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 text-uppercase mt-3">Actualizar</button>
                    </form>

                    <a href="<?= base_url('admin/marcas') ?>" class="btn btn-secondary w-100 mt-2">← Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>