<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-5">

                <h2 class="text-uppercase mb-4">Detalle de Venta #<?= $venta['id_venta'] ?></h2>

                <p class="mb-0"><strong>Cliente:</strong> <?= $venta['usuario_nombre'] . ' ' . $venta['usuario_apellido'] ?></p>
                <p class="mb-0"><strong>Email:</strong> <?= $venta['usuario_email'] ?></p>
                <p class="mb-0"><strong>Fecha:</strong> <?= $venta['venta_fecha'] ?></p>

                <hr>

                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Precio unitario</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($detalles as $detalle): ?>
                        <tr>
                            <td><?= $detalle['producto_nombre'] ?></td>
                            <td>$<?= number_format($detalle['precio_unitario'], 2) ?></td>
                            <td><?= $detalle['cantidad'] ?></td>
                            <td>$<?= number_format($detalle['precio_unitario'] * $detalle['cantidad'], 2) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <hr>

                <div class="text-end">
                    <h4>Total: $<?= number_format($venta['total'], 2) ?></h4>
                </div>

                <hr>

                <a href="<?= base_url('admin/ventas') ?>" class="btn btn-secondary">← Volver a ventas</a>

            </div>
        </div>
    </div>
</div>