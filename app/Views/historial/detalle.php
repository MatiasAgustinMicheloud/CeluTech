<div class="container" style="padding-top: 120px; margin-bottom: 50px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow p-5">

                <h2 class="text-uppercase mb-4">Detalle de Compra #<?= $venta['id_venta'] ?></h2>

                <p class="mb-0"><strong>Fecha:</strong> <?= $venta['venta_fecha'] ?></p>
                <?php if($factura): ?>
                    <p class="mb-0"><strong>Factura #:</strong> <?= $factura['id_factura'] ?></p>
                <?php endif; ?>

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

                <a href="<?= base_url('historial') ?>" class="btn btn-secondary">← Volver a mis compras</a>

            </div>
        </div>
    </div>
</div>