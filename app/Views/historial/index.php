<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <h2 class="text-uppercase mb-4">Mis Compras</h2>

    <?php if(empty($ventas)): ?>
        <div class="alert alert-info">
            Todavía no realizaste ninguna compra. <a href="<?= base_url('catalogo') ?>">Ver productos</a>
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Venta #</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($ventas as $venta): ?>
                <tr>
                    <td><?= $venta['id_venta'] ?></td>
                    <td><?= $venta['venta_fecha'] ?></td>
                    <td>$<?= number_format($venta['total'], 2) ?></td>
                    <td>
                        <a href="<?= base_url('historial/' . $venta['id_venta']) ?>" class="btn btn-sm btn-dark">Ver detalle</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="<?= base_url('catalogo') ?>" class="btn btn-secondary mt-3">← Seguir comprando</a>
</div>