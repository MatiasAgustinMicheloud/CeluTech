<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-uppercase">Marcas</h2>
        <a href="<?= base_url('admin/marcas/crear') ?>" class="btn btn-dark">+ Nueva Marca</a>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($marcas as $marca): ?>
            <tr>
                <td><?= $marca['id_marca'] ?></td>
                <td><?= $marca['marca_nombre'] ?></td>
                <td>
                    <?php if($marca['marca_estado'] == 1): ?>
                        <span class="badge bg-success">Activo</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Inactivo</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= base_url('admin/marcas/editar/' . $marca['id_marca']) ?>" class="btn btn-sm btn-warning">Editar</a>
                    <a href="<?= base_url('admin/marcas/eliminar/' . $marca['id_marca']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro?')">Desactivar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary mt-3">← Volver al panel</a>
</div>