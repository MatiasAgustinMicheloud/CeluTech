<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <h2 class="text-uppercase mb-4">Ventas</h2>


    <form method="GET" action="<?= base_url('admin/ventas') ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Fecha desde</label>
            <input type="date" name="fecha_desde" class="form-control" value="<?= $fecha_desde ?? '' ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Fecha hasta</label>
            <input type="date" name="fecha_hasta" class="form-control" value="<?= $fecha_hasta ?? '' ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end gap-2">
            <button type="submit" class="btn btn-dark">Filtrar</button>
            <a href="<?= base_url('admin/ventas') ?>" class="btn btn-secondary">Limpiar</a>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Venta #</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($ventas as $venta): ?>
            <tr>
                <td><?= $venta['id_venta'] ?></td>
                <td><?= $venta['usuario_nombre'] . ' ' . $venta['usuario_apellido'] ?></td>
                <td><?= $venta['venta_fecha'] ?></td>
                <td>$<?= number_format($venta['total'], 2) ?></td>
                <td>
                    <a href="<?= base_url('admin/ventas/' . $venta['id_venta']) ?>" class="btn btn-sm btn-dark">Ver detalle</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-secondary mt-3">← Volver al panel</a>
</div>